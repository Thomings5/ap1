<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Package $package
 * @var \Cake\Collection\CollectionInterface|string[] $sheets
 */
?>
<div class="row">
    <aside class="column">
    </aside>
    <div class="column-responsive column-80">
        <div class="packages form content">
            <?= $this->Form->create($package) ?>
            <fieldset>
                <legend><?= __('Ajouter un forfait') ?></legend>
                <?php
                     echo $this->Form->control('price', ['label' => 'Prix']);
                     echo $this->Form->control('title', ['label' => 'Titre']);
                     echo $this->Form->control('body', ['label' => 'Description']);
                    //echo $this->Form->control('sheets._ids', ['options' => $sheets]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Envoyer')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
