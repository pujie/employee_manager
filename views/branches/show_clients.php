<?php
echo $css;
echo $title;
echo '<div><strong>Total Rows:' . $total_rows . '</strong></div><p>';
echo $this->pagination->create_links();
$this->lib_table_manager->create_table($list);
echo $this->pagination->create_links();
$this->lib_table_manager->create_table($navigator);
$this->menu->links($links);