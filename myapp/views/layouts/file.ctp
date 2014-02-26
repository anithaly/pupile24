<?php 
  header('Content-type: ' . $photo['PetsPhoto']['content_type']);
  header('Content-length: ' . $photo['PetsPhoto']['file_size']);
  print $content_for_layout;