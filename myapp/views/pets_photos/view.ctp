<div class="petsPhotos view single">
  <h2><?php echo $PetsPhoto['PetsPhoto']['title']; ?></h2>
  <?php $photo = '<img src="'. UPLOADS_PATH . 'big_' . $PetsPhoto['PetsPhoto']['name'] . '" alt="' . $PetsPhoto['PetsPhoto']['title'].'" />'; ?>
  <div class="photo">
    <?php echo $photo;?>
  </div>
</div>