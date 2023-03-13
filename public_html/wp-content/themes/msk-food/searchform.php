<div class="header__search">
  <form role="search" method="get" id="search-form" action="<?php echo esc_url(home_url('/')); ?>" class="input-group mb-3">
    <input type="search" class="form-control border-1" placeholder="Поиск по каталогу" aria-label="search nico" name="s" id="search-input" value="<?php echo esc_attr(get_search_query()); ?>">

  </form>
</div>