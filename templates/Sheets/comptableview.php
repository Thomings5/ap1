<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sheet $sheet
 */

use App\Model\Entity\Outpackage;

 $identity = $this->getRequest()->getAttribute('identity');
$identity = $identity ?? [];
$iduser = $identity["id"];

$total = 0;
$total_package = 0;
$total_outpackage = 0;
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?php if ($sheet->state->id == 1 && !$sheet->sheetvalidated): ?>
                <?= $this->Form->postLink(__('Delete Sheet'), ['action' => 'delete', $sheet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sheet->id), 'class' => 'side-nav-item']) ?>
            <?php endif; ?>
            <?= $this->Html->link(__('List Sheets'), ['action' => 'list'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="sheets view content">
            <h3><?= h($sheet->id) ?></h3>
            <table>
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
            
            <div class="related">
                <h4 class="float-left"><?= __('Listes des Forfaits') ?></h4>
                <?= $this->Form->create($sheet, ['url' => ['controller' => 'Sheets', 'action' => 'clientview', $sheet->id]]) ?>
                <?php if (!empty($sheet->packages)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th><?= __('Quantité') ?></th>
                                <th><?= __('Prix') ?></th>
                                <th><?= __('Titre') ?></th>
                                <th><?= __('Messeage') ?></th>
                            </tr>
                            <?php foreach ($sheet->packages as $package) : ?>
                                <tr>
                                    <td><?= h($package->id) ?></td>
                                    <?php if ($sheet->state->id == 1 && !$sheet->sheetvalidated): ?>
                                        
                                        <td>
                                            <?= $this->Form->hidden("packages.{$package->id}.id", ['value' => $package->_joinData->id]) ?>
                                            <?= $package->_joinData->quantity ?>
                                    <?php else: ?>
                                        <td><?php echo $package->_joinData->quantity ?></td>
                                    <?php endif; ?>
                                    <td><?= h($package->price) ?> €</td>
                                    <td><?= h($package->title) ?></td>
                                    <!-- Limiter la taille du champ body à 100 caractères -->
                                    <td title="<?= h($package->body) ?>">
                                        <?= h(substr($package->body, 0, 100)) ?> ...
                                    </td>
                                    <?php if ($sheet->state->id == 1 && !$sheet->sheetvalidated): ?>
        
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
                    <div style="margin-top: 1rem;">
                        <?php if ($sheet->state->id == 1 && !$sheet->sheetvalidated): ?>
                            <td>
                                <?= $this->Form->hidden('action', ['value' => '']) ?>

                            </td> 
                        <?php endif; ?>
                        <?= '<strong style="margin-left: 1rem">Total forfaits : </strong>'.$total_package." €" ?>
                    </div>
                <?php endif; ?>
                <?= $this->Form->end() ?>

                        <!-- Calcul du total -->
                
            </div>
            <div class="related">
                <h4 class="float-left"><?= __('Listes des Hors Forfaits') ?></h4>
                <?php if($sheet->state->id == 1): ?>
                <?php endif; ?>
                <?php if (!empty($sheet->outpackages)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Date') ?></th>
                            <th><?= __('Prix') ?></th>
                            <th><?= __('Titre') ?></th>
                            <th><?= __('Message') ?></th>
                        </tr>
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
                        </tr>
                        <?php $total_outpackage = $total_outpackage + $outpackages->price; ?>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
                <?= '<div style="margin-top: 1rem"><strong>Total hors forfaits : </strong>'.$total_outpackage." €</div>" ?>
                <?= '</br><strong>Total : </strong>'.$total = $total_outpackage + $total_package." €" ?>
            </div>
            
        </div>
    </div>
</div>