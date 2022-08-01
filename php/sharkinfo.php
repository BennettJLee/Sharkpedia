<?php
    $sharkInfo = $_GET['id']; //gets from url when form is submitted... perhaps it can just get from url?

    // if the id parameter is missing or empty it does not break the site it's like a try and catch statement
    if (empty($sharkInfo) || is_null($sharkInfo)) {
        http_response_code(404);
    }

    // loads the xml doc file in
    $doc = new DOMDocument();
    $doc->load('../Sharkpedia/sharks.xml');

    $sharks = $doc->getElementsByTagName('shark');

    $shark = null;

    foreach ($sharks as $s) {
        if ($s->getAttribute('id') == $sharkInfo) {
            $shark = $s;
        }
    }

    // if the list couldn't find a shark matching the id, e.g. shark0 the code above the query as  null and then the if statement throughs up a 404 response instead of breaking
    if (is_null($shark)) {
        http_response_code(404);
    }

    /**/

    // class.object.item.string kind of idea going on here, or container string like c#. where node value is parsing it as a string
    $name = $shark->getElementsByTagName('name')->item(0)/*at item 0, first item is the name*/->nodeValue; /*nodeValue grabs the string from inside item 0*/
    $namesci = $shark->getElementsByTagName('namesci')->item(0)->nodeValue;
    $lifespan = $shark->getElementsByTagName('lifespan')->item(0)->nodeValue;
    $size = $shark->getElementsByTagName('size')->item(0)->nodeValue;
    $physical = $shark->getElementsByTagName('physical')->item(0)->nodeValue;
    $imagePath = $shark->getElementsByTagName('image')->item(0)->getAttribute('path');
    $st = $shark->getElementsByTagName('st')->item(0)->nodeValue;
    $status = $shark->getElementsByTagName('status')->item(0)->nodeValue;
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
      <link rel="stylesheet" href="../css/styles.css">
  </head>
  <body id="browseBG">
    <?php include 'navbar.php'; ?>
    <a id="back" href="browse.php"><span>Back</span></a>
    <div id="allCard">
      <div id="resultTitle">
        <h1 id="name"><?php echo $name; ?></h1>
        <h3 id="sciname"><?php echo $namesci; ?></h3>
      </div>
      <div class="sharkCard">
        <div class="imgmask">
          <img src="../Sharkpedia/imagesharks/<?php echo $imagePath ?>" alt="Shark Image">
        </div>
          <div class="rdescription">
            <h3>CONSERVATION STATUS:</h3>
            <?php
            echo "<div class='statDiv' id='$st'>";
            echo "<p id='p2'>$st</p>";
            echo "</div>";
            ?>
            <p><?php echo $status; ?></p>
            <h3>LIFE SPAN:</h3>
            <p><?php echo $lifespan; ?></p> <!--prints the var lifespan to the html-->
            <h3>SIZE:</h3>
            <p><?php echo $size; ?></p>
            <h3>PHYSICAL CHARACTERISTICS:</h3>
            <p><?php echo $physical; ?></p>
          </div>
        </div>
      </div>
  </body>
</html>
