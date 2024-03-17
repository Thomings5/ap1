<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Sheet> $sheets
 * 
 * 
 * <th><?= $this->Paginator->sort('user_id') ?></th>
 * $sheet->has('user') ? $this->Html->link($sheet->user->username, ['controller' => 'Users', 'action' => 'view', $sheet->user->id]) : ''
 */


$identity = $this->getRequest()->getAttribute('identity');
$identity = $identity ?? [];
$iduser = $identity["id"]

?>
<div class="sheets index content"> 
    <h3><?= __('Fiches des utilisateurs') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('Utilisateur') ?></th>
                    <th><?= $this->Paginator->sort('Etat') ?></th>
                    <th><?= $this->Paginator->sort('Fiche validée') ?></th>
                    <th><?= $this->Paginator->sort('Date de Création') ?></th>
                    <th><?= $this->Paginator->sort('Date de Modification') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sheets as $sheet): ?>
                    <tr>
                        <td><?= $this->Number->format($sheet->id) ?></td>
                        <td><?= $sheet->has('user') ? $this->Html->link($sheet->user->username, ['controller' => 'Users', 'action' => 'view', $sheet->user->id]) : '' ?></td>
                        <td><?= $sheet->has('state') ? $this->Html->link($sheet->state->state, ['controller' => 'Sheets', 'action' => 'edit', $sheet->id]) : '' ?></td>
                        <td><?= h($sheet->sheetvalidated) ?></td>
                        <td><?= h($sheet->created) ?></td>
                        <td><?= h($sheet->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('Voir'), ['controller' => 'Sheets', 'action' => 'comptableview', $sheet->id]) ?>
                            <td class="actions">
                            <td class="actions">
                                <?php if ($sheet->state->id === 1): ?>
                                    <?= $this->Html->link(__('Valider'), ['controller' => 'Sheets', 'action' => 'edit', $sheet->id]) ?>
                                <?php else: ?>
                                    <?= __('Validée') ?>
                                <?php endif; ?>
                            </td>

                            <!-- $this->Form->postLink(__('Delete'), ['action' => 'delete', $sheet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sheet->id)]) -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('Premier')) ?>
            <?= $this->Paginator->prev('< ' . __('Précédent')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Prochain') . ' >') ?>
            <?= $this->Paginator->last(__('Dernier') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} sur {{pages}}, Montrant {{current}} Enregistré(e)(s) sur un total de {{count}}')) ?></p>
    </div>
</div>
