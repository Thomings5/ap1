<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Package> $packages
 */
?>
<div class="packages index content">
    <?= $this->Html->link(__('Nouveau frais'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Frais') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('Prix') ?></th>
                    <th><?= $this->Paginator->sort('Titre') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($packages as $package): ?>
                <tr>
                    <td><?= $this->Number->format($package->id) ?></td>
                    <td><?= $this->Number->format($package->price) ?></td>
                    <td><?= h($package->title) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Voir'), ['action' => 'view', $package->id]) ?>
                        <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $package->id]) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $package->id], ['confirm' => __('Etes-vous sur de supprimer ce frais # {0}?', $package->id)]) ?>
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
        <p><?= $this->Paginator->counter(__('Page {{page}} sur {{pages}}, montrant {{current}} enregistré(s) sur un total de {{count}}')) ?></p>
    </div>
</div>
