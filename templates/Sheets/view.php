<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sheet $sheet
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Sheet'), ['action' => 'edit', $sheet->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Sheet'), ['action' => 'delete', $sheet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sheet->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Sheets'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Sheet'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="sheets view content">
            <h3><?= h($sheet->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $sheet->has('user') ? $this->Html->link($sheet->user->username, ['controller' => 'Users', 'action' => 'view', $sheet->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('State') ?></th>
                    <td><?= $sheet->has('state') ? $this->Html->link($sheet->state->state, ['controller' => 'States', 'action' => 'view', $sheet->state->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($sheet->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($sheet->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($sheet->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sheetvalidated') ?></th>
                    <td><?= $sheet->sheetvalidated ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            
            <div class="related">
                <h4><?= __('Related Outpackages') ?></h4>
                <?= $this->Html->link(__('New Outpackage'), ['controller' => 'outpackages' ,'action' => 'add'], ['class' => 'button float-right']) ?>
                <?php if (!empty($sheet->outpackages)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Price') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Body') ?></th>
                            <th><?= __('Quantity') ?></th>
                            <th><?= __('Total') ?></th>
                            
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($sheet->outpackages as $outpackages) : ?>
                        <tr>
                            <td><?= h($outpackages->id) ?></td>
                            <td><?= h($outpackages->price) ?></td>
                            <td><?= h($outpackages->title) ?></td>
                            <td><?= h($outpackages->body) ?></td>
                            <td>
                                <?= $this->Form->create(null, ['url' => ['controller' => 'Outpackages', 'action' => 'create', $outpackages->id]]) ?>
                                <?= $this->Form->hidden("outpackages.{$outpackages->id}.id", ['value' => $outpackages->_joinData->id]) ?>
                                <?= $this->Form->control("outpackages.{$outpackages->id}.quantity", ['type' => 'text', 'label' => false, 'value' => isset($outpackages->_joinData->quantity) ? $outpackages->_joinData->quantity :0]) ?>
                            </td>
                            <td>
                            <?php $quantityoutpackages = $outpackages->_joinData->quantity;
                                 $priceoutpackages = $outpackages->price;
                                 $totaloutpackages=$quantityoutpackages*$priceoutpackages;?>
                                <?php echo ($totaloutpackages); ?>
                            </td>
                            
                           
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Outpackages', 'action' => 'view', $outpackages->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Outpackages', 'action' => 'edit', $outpackages->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Outpackages', 'action' => 'delete', $outpackages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $outpackages->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Packages') ?></h4>
                <?= $this->Html->link(__('New Package'), ['controller' => 'Packages', 'action' => 'add'], ['class' => 'button float-right']) ?>
                <?php if (!empty($sheet->packages)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Price') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Body') ?></th>
                            <th><?= __('Quantity') ?></th>
                            <th><?= __('Total') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($sheet->packages as $packages) : ?>

                        <tr>
                            
                            <td><?= h($packages->id) ?></td>
                            <td><?= h($packages->price) ?></td>
                            <td><?= h($packages->title) ?></td>
                            <td><?= h($packages->body) ?></td>
                            <td>
                                <?= $this->Form->create(null, ['url' => ['controller' => 'Packages', 'action' => 'create', $packages->id]]) ?>
                                <?= $this->Form->hidden("packages.{$packages->id}.id", ['value' => $packages->_joinData->id]) ?>
                                <?= $this->Form->control("packages.{$packages->id}.quantity", ['type' => 'text', 'label' => false, 'value' => isset($packages->_joinData->quantity) ? $packages->_joinData->quantity :0]) ?>
                            </td>
                            <td>
                            <?php $quantitypackages = $packages->_joinData->quantity;
                                 $pricepackages = $packages->price;
                                 $totalpackages=$quantitypackages*$pricepackages;?>
                                <?php echo ($totalpackages); ?>
                            </td>

                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Packages', 'action' => 'view', $packages->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Packages', 'action' => 'edit', $packages->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Packages', 'action' => 'delete', $packages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $packages->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
