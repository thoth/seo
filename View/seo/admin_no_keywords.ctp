<?php
    $this->Html->script(array('nodes'), false);
?>
<div class="nodes index">
    <h2><?php echo $title_for_layout; ?></h2>

    <?php echo $this->Form->create('Node', array('url' => array('controller' => 'nodes', 'action' => 'process'))); ?>
    <table cellpadding="0" cellspacing="0">
    <?php
        $tableHeaders =  $this->Html->tableHeaders(array(
            '',
            'ID',
            'Title',
            'Type',
            'User',
            'Status',
            'Promote',
            __('Actions', true),
        ));
        echo $tableHeaders;

        $rows = array();
        foreach ($nodes AS $node) {
            $actions  = $this->Html->link(__('Edit', true), array('action' => 'edit', $node['Node']['id']));
            $actions .= ' ' . $this->Layout->adminRowActions($node['Node']['id']);
            $actions .= ' ' . $this->Html->link(__('Delete', true), array(
                'action' => 'delete',
                $node['Node']['id'],
                'token' => $this->params['_Token']['key'],
            ), null, __('Are you sure?', true));

            $rows[] = array(
                $this->Form->checkbox('Node.'.$node['Node']['id'].'.id'),
                $node['Node']['id'],
                $this->Html->link($node['Node']['title'], array(
                    'admin' => false,
                    'controller' => 'nodes',
                    'action' => 'view',
                    'type' => $node['Node']['type'],
                    'slug' => $node['Node']['slug'],
                )),
                $node['Node']['type'],
                $node['User']['username'],
                $this->Layout->status($node['Node']['status']),
                $this->Layout->status($node['Node']['promote']),
                //$node['Node']['created'],
                $actions,
            );
        }

        echo $this->Html->tableCells($rows);
    ?>
    </table>

    <div class="bulk-actions">
    <?php
        echo $this->Form->input('Node.action', array(
            'label' => false,
            'options' => array(
                'publish' => __('Publish', true),
                'unpublish' => __('Unpublish', true),
                'promote' => __('Promote', true),
                'unpromote' => __('Unpromote', true),
                //'delete' => __('Delete', true),
            ),
            'empty' => true,
        ));
        echo $this->Form->end(__('Submit', true));
    ?>
    </div>
</div>
