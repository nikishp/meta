<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Все страницы</title>
    <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="css/libs.css">
    <link rel="stylesheet" href="css/main.css">
  </head>
  <body>

    <style>
      li{
        margin-bottom: 10px;
      }
    </style>
    <ol>
      <?php foreach (glob("*.html") as $page): ?>
      <li>
        <a href="<?php echo $page ?>" target="_blank">
          <?php
          $dom = new DOMDocument();
          $tag = 'title';
          @$dom->loadHTML(@file_get_contents($page));

          if ($dom->getElementsByTagName($tag)->length > 0){
            $title = $dom->getElementsByTagName($tag)->item(0)->textContent;
            echo $title;
          }
          ?>

        </a>
      </li>
      <?php endforeach; ?>
    </ol>

    <?php
    /*
  function getFileList($dir)
  {
      // array to hold return value
    $retval = [];

      // add trailing slash if missing
    if(substr($dir, -1) != "/") {
      $dir .= "/";
    }

      // open pointer to directory and read list of files
    $d = @dir($dir) or die("getFileList: Failed opening directory {$dir} for reading");
    while(FALSE !== ($entry = $d->read())) {
        // skip hidden files
      if($entry{0} == ".") continue;
      if(is_dir("{$dir}{$entry}")) {
        $retval[] = [
//            'name' => "{$dir}{$entry}/",
          'name' => "{$dir}{$entry}",
          'type' => filetype("{$dir}{$entry}"),
          'size' => 0,
          'lastmod' => filemtime("{$dir}{$entry}")
        ];
      } elseif(is_readable("{$dir}{$entry}")) {
        $retval[] = [
          'name' => "{$dir}{$entry}",
          'type' => mime_content_type("{$dir}{$entry}"),
          'size' => filesize("{$dir}{$entry}"),
          'lastmod' => filemtime("{$dir}{$entry}")
        ];
      }
    }
    $d->close();

    return $retval;
  }

  $dirlist = getFileList(".");

    // output file list in HTML TABLE format
  echo '<ul>';
  foreach($dirlist as $file) {
    if($file['type'] == 'text/html' && $file['name'] != './all-page.php'){

     $dom = new DOMDocument();
     $tag = 'title';
     @$dom->loadHTML(@file_get_contents($file['name']));

     if ($dom->getElementsByTagName($tag)->length > 0){
      $title = $dom->getElementsByTagName($tag)->item(0)->textContent;
      // echo $title;
    }
    else{
      $title = '';
      // echo 'else '.$title;
    }
    // echo "<li><a href=\"{$file['name']}\">",basename($file['name']),"</a></li>";
    echo "<li><a href=\"{$file['name']}\">",$title,"</a></li>";
        //        echo "<td>{$file['type']}</td>\n";
        //        echo "<td>{$file['size']}</td>\n";
        //        echo "<td>",date('r', $file['lastmod']),"</td>\n";
  }
};
echo '</ul>';
*/
    ?>

  </body>
</html>
