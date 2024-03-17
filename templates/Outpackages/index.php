<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Outpackage> $outpackages
 */
?>
<div class="outpackages index content">
    <?= $this->Html->link(__('New Outpackage'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Outpackages') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('date', 'Date') ?></th>
                    <th><?= $this->Paginator->sort('price', 'Prix') ?></th>
                    <th><?= $this->Paginator->sort('title', 'Titre') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($outpackages as $outpackage): ?>
                <tr>
                    <td><?= $this->Number->format($outpackage->id) ?></td>
                    <td><?= h($outpackage->date) ?></td>
                    <td><?= $this->Number->format($outpackage->price) ?></td>
                    <td><?= h($outpackage->title) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Voir'), ['action' => 'view', $outpackage->id]) ?>
                        <?= $this->Html->link(__('Editer'), ['action' => 'edit', $outpackage->id]) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $outpackage->id], ['confirm' => __('Etes-vous sur de vouloir supprimercette ligne # {0}?', $outpackage->id)]) ?>
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
        <p><?= $this->Paginator->counter(__('Page {{page}} de {{pages}}, montrant {{current}} enregistré(e)(s) sur un total de {{count}} ')) ?></p>
    </div>
</div>
