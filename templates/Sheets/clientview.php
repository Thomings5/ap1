<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sheet $sheet
 */

use App\Model\Entity\Outpackage;

// Obtenir l'identité de l'utilisateur connecté s'il existe
 $identity = $this->getRequest()->getAttribute('identity');
$identity = $identity ?? [];
$iduser = $identity["id"];

// Initialisation des totaux
$total = 0;
$total_package = 0;
$total_outpackage = 0;
?>
<div class="row">
    <aside class="column">
    </aside>
    <div class="column-responsive column-80">
        <div class="sheets view content">
            <!-- Affichage des détails de la fiche -->
            <h3><?= h($sheet->id) ?></h3>
            <table>
                <!-- Affichage des informations de l'utilisateur -->
                <tr>
                    <th><?= __('Nom de famille') ?></th>
                    <td><?= $sheet->user->last_name ?></td>
                </tr>
                <tr>
                    <th><?= __('Prénom') ?></th>
                    <td><?= $sheet->user->first_name ?></td>
                </tr>
                <tr>
                    <th><?= __('Etat') ?></th>
                    <td><?= $sheet->state->state ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($sheet->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Créé') ?></th>
                    <td><?= h($sheet->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifié') ?></th>
                    <td><?= h($sheet->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fiche validée') ?></th>
                    <td><?= $sheet->sheetvalidated ? __('Oui') : __('Non'); ?></td>
                </tr>
            </table>

             <!-- Section des forfaits associés à la fiche -->
            
            <div class="related">
                <h4 class="float-left"><?= __('Listes des Forfaits') ?></h4>
                <?= $this->Form->create($sheet, ['url' => ['controller' => 'Sheets', 'action' => 'clientview', $sheet->id]]) ?>
                <!-- Affichage des forfaits -->
                <?php if (!empty($sheet->packages)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th><?= __('Quantité') ?></th>
                                <th><?= __('Prix') ?></th>
                                <th><?= __('Titre') ?></th>
                                <th><?= __('Message') ?></th>
                            </tr>
                            <!-- Boucle sur les forfaits -->
                            <?php foreach ($sheet->packages as $package) : ?>
                                <tr>
                                    <td><?= h($package->id) ?></td>
                                    <!-- Affichage de la quantité -->
                                    <?php if ($sheet->state->id == 1 && !$sheet->sheetvalidated): ?>
                                        
                                        <td>
                                            <?= $this->Form->hidden("packages.{$package->id}.id", ['value' => $package->_joinData->id]) ?>
                                            <?= $this->Form->control("packages.{$package->id}.quantity", ['type' => 'text', 'label' => false, 'value' => isset($package->_joinData->quantity) ? $package->_joinData->quantity : 0]) ?>
                                        </td>
                                    <?php else: ?>
                                        <td><?php echo $package->_joinData->quantity ?></td>
                                    <?php endif; ?>
                                     <!-- Affichage du prix -->
                                    <td><?= h($package->price) ?> €</td>
                                    <td><?= h($package->title) ?></td>
                                    <!-- Limiter la taille du champ body à 100 caractères -->
                                    <td title="<?= h($package->body) ?>">
                                        <?= h(substr($package->body, 0, 100)) ?> ...
                                    </td>
                                    <?php if ($sheet->state->id == 1 && !$sheet->sheetvalidated): ?>
                                          <!-- Suppression du forfait (visible uniquement si la fiche n'est pas validée) -->
        
                                        <td style="display: none">
                                            <?= $this->Form->postLink(__('None')) ?>
                                        </td>
                                    <?php endif; ?>
                                    <!-- Calcul du total -->
                                </tr>
                                <?php $total_package += ($package->_joinData->quantity * $package->price) ?>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <!-- Affichage du bouton de sauvegarde des forfaits  pour tout simplement les calucer-->
                    <div style="margin-top: 1rem;">
                        <?php if ($sheet->state->id == 1 && !$sheet->sheetvalidated): ?>
                            <td>
                                <?= $this->Form->hidden('action', ['value' => '']) ?>
                                <?= $this->Form->button('Sauvegarder', ['type' => 'submit']) ?>
                            </td> 
                        <?php endif; ?>
                        <!-- Affichage du total des forfaits -->
                        <?= '<strong style="margin-left: 1rem">Total forfaits : </strong>'.$total_package." €" ?>
                    </div>
                <?php endif; ?>
                <?= $this->Form->end() ?>

                        <!-- Calcul du total -->
                

                        <!-- Section des hors forfaits -->
            </div>
            <div class="related">
                <h4 class="float-left"><?= __('Listes des Hors Forfaits') ?></h4>
                <!-- Affichage du bouton pour ajouter un nouvel hors forfait -->
                <?php if($sheet->state->id == 1): ?>
                    <?php if($sheet->sheetvalidated == false): ?>
                        <?= $this->Html->link(__('Nouveau hors forfait'), ['action' => 'add', 'controller' => 'Outpackages',$sheet->id], ['class' => 'button float-right']) ?>
                    <?php endif; ?>
                <?php endif; ?>
                <!-- Affichage des hors forfaits -->
                <?php if (!empty($sheet->outpackages)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Prix') ?></th>
                            <th><?= __('Titre') ?></th>
                            <th><?= __('Message') ?></th>
                            <?php if($sheet->state->id == 1): ?>
                                <?php if($sheet->sheetvalidated == false): ?>
                                    <th class="actions"><?= __('Actions') ?></th>
                                <?php endif; ?>
                            <?php endif; ?>
                        </tr>
                        <!-- Boucle sur les hors forfaits -->
                        <?php foreach ($sheet->outpackages as $outpackages) : ?>
                        <tr>
                            <td><?= h($outpackages->id) ?></td>
                            <td><?= h($outpackages->date) ?></td>
                            <td><?= h($outpackages->price) ?> €</td>
                            <td><?= h($outpackages->title) ?></td>
                            <!-- Limiter la taille du champ body à 100 caractères -->
                            <td title="<?= h($outpackages->body) ?>">
                                <?= h(substr($outpackages->body, 0, 100)) ?> ...
                            </td>
                            <!-- Affichage des actions (suppression) -->
                            <?php if($sheet->state->id == 1): ?>
                                <?php if($sheet->sheetvalidated == false): ?>
                                    <td class="actions">
                                        <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Outpackages', 'action' => 'delete', $outpackages->id, $sheet->id], ['confirm' => __('Etes-vous sur de vouloir supprimer cet hors forfait? # {0}?', $outpackages->id)]) ?>
                                    </td>
                                <?php endif; ?>
                            <?php endif; ?>
                        </tr>
                        <?php $total_outpackage = $total_outpackage + $outpackages->price; ?>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
                <!-- Affichage du total des hors forfaits et du total général -->
                <?= '<div style="margin-top: 1rem"><strong>Total hors forfaits : </strong>'.$total_outpackage." €</div>" ?>
                <?= '</br><strong>Total : </strong>'.$total = $total_outpackage + $total_package." €" ?>
            </div>
            
        </div>
    </div>
</div>