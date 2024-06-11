<!-- <ul>
    <li><a href="#">Stadt 1</a></li>
    <li><a href="#">Stadt 2</a></li>
</ul> -->

<?php
    $cities = ['london', 'paris', 'berlin'];
?>
<ul>
    <?php foreach($cities as $city) :?>
    <li><a href="<?php echo '/' . $city . 'php' ?>"><?php echo ucfirst($city)?></a></li>
    <?php endforeach; ?>
</ul>