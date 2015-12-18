<?php
require_once '../bootstrap.php';

$limit    = 12;
$pageID   = Input::has('page') ? Input::get('page') : 1;
$offset   = $limit * $pageID - $limit;

$stmt = $dbc->prepare("SELECT * FROM ads LIMIT :limit OFFSET :offset");
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->execute();

$count    = $dbc->query('SELECT COUNT(*) FROM ads;')->fetchColumn();
$ads      = $stmt->fetchAll(PDO::FETCH_ASSOC);
$numPages = ceil($count / $limit);
$next     = $pageID + 1;
$previous = $pageID -1;
?>


<!DOCTYPE html>
<body>
    <div id="content" class="container">
        <div id="extra-search-small" class="row">
            <div class="hero-small center-block">
                <div class="search-wrap">
                    <div id="ap_slod_wrap" class="ap_int_search_mod">
                        <div id="ap_slod_categories" class="ap_sys_align_none ap_slod_width_2">
                            <select class="ap_search_categories" style="display: none;">
                                <option id="" value="all-categories">All Categories</option>
                                    <optgroup class="ap_sub_cats">
                                        <option id="" value="bulletin-board"> Bulletin Board </option>
                                        <option id="" value="business-service-directory"> Business Service Directory </option>
                                        <option id="" value="business-to-business"> Business To Business </option>
                                        <option id="" value="commercial-real-estate"> Commercial Real Estate </option>
                                        <option id="" value="education"> Education </option>
                                        <option id="" value="jobs"> Jobs </option>
                                        <option id="" value="other-real-estate"> Other Real Estate </option>
                                        <option id="" value="other-transportation"> Other Transportation </option>
                                        <option id="" value="real-estate-for-rent"> Real Estate For Rent </option>
                                        <option id="" value="stuff"> Stuff </option>
                                    </optgroup>
                            </select>
                                <div class="btn-group bootstrap-select ap_search_categories">
                                    <button type="button" class="btn dropdown-toggle selectpicker btn-default" data-toggle="dropdown" title="All Categories">
                                        <span class="filter-option pull-left">All Categories</span>&nbsp;<span class="caret"></span>
                                    </button>
                                    <div class="dropdown-menu open">
                                        <ul class="dropdown-menu inner selectpicker" role="menu">
                                            <li rel="0" class="selected"><a tabindex="0" class="" style=""><span class="text">All Categories</span></a></li>
                                            <li rel="1"><a tabindex="0" class="opt " style=""><span class="text"> Automobiles </span></a></li>
                                            <li rel="2"><a tabindex="0" class="opt " style=""><span class="text"> Bionic parts </span></a></li>
                                            <li rel="3"><a tabindex="0" class="opt " style=""><span class="text"> Commercial Real Estate </span></a></li>
                                            <li rel="4"><a tabindex="0" class="opt " style=""><span class="text"> Education </span></a></li>
                                            <li rel="5"><a tabindex="0" class="opt " style=""><span class="text"> Jobs </span></a></li>
                                            <li rel="6"><a tabindex="0" class="opt " style=""><span class="text"> Pets </span></a></li>
                                            <li rel="7"><a tabindex="0" class="opt " style=""><span class="text"> Home </span></a></li>
                                            <li rel="8"><a tabindex="0" class="opt " style=""><span class="text"> For Rent </span></a></li>
                                            <li rel="9"><a tabindex="0" class="opt " style=""><span class="text"> Other </span></a></li>
                                        </ul>
                                    </div>
                                </div>
                        </div>
                        <div id="ap_slod_keywords_wrap" class="ap_sys_align_none ap_slod_width_2">
                            <input type="text" id="ap_slod_keywords" class="form-control" value="">
                        </div>
                        <div class="search-button-wrap">
                            <div class="search-button-wrap">
                                <div id="ap_slod_submit" class="ap_sys_align_none ap_slod_width_2 btn btn-primary">Search</div>
                            </div>
                        </div>
                        <div class="ap_sys_clear"></div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div id="ads" class="container">
        </div>
        <nav>
        <ul class="pager">
            <li class="previous"><?php if ($pageID != 1) : ?>
                <a href="?page=<?= ($previous) ?>">Previous</a>
            <?php endif ?></li>
          
            <li class="next"><?php if ($pageID < $numPages) : ?>
                <a href="?page=<?= ($next) ?>">Next</a>
            <?php endif ?> </li>
        </ul>
    </nav>
</body>
