<nav class="datatable-pagination">
    <ul class="datatable-pagination-list">
        <!-- <li class="datatable-pagination-list-item">
            <a data-page="1" class="datatable-pagination-list-item-link">‹</a></li>
        <li class="datatable-pagination-list-item">
            <a data-page="1" class="datatable-pagination-list-item-link">1</a></li>
        <li class="datatable-pagination-list-item datatable-active">
            <a data-page="2" class="datatable-pagination-list-item-link">2</a></li>
        <li class="datatable-pagination-list-item">
            <a data-page="3" class="datatable-pagination-list-item-link">3</a></li>
        <li class="datatable-pagination-list-item">
            <a data-page="4" class="datatable-pagination-list-item-link">4</a></li>
        <li class="datatable-pagination-list-item">
            <a data-page="5" class="datatable-pagination-list-item-link">5</a></li>
        <li class="datatable-pagination-list-item">
            <a data-page="6" class="datatable-pagination-list-item-link">6</a></li>
        <li class="datatable-pagination-list-item">
            <a data-page="3" class="datatable-pagination-list-item-link">›</a></li> -->

        <?php 
        foreach ($pager->links() as $link) {
            $activeclass = $link['active'] ? 'active' : ' ';
            ?>
            <li class="<?php echo $activeclass; ?>">
                <a href="<?php echo $link['uri']; ?>"><?php echo $link['title']; ?></a>
            </li>
            <?php

        }
        ?>
    </ul>
</nav>