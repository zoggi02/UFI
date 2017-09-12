<?php
// function to get meta description
/*function getDescription($url) {
    $tags = get_meta_tags($url);
    return @($tags['description'] ? $tags['description'] : "NULL");
}
// get web page meta description
echo 'Meta Description: ' . getDescription('http://www.w3schools.com/php/');

// Output:
// Meta Description: Well organized and easy to understand Web bulding tutorials with lots of examples of how to use HTML, CSS, JavaScript, SQL, PHP, and XML.


// function to get webpage title
function getTitle($url) {
    $page = file_get_contents($url);
    $title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $page, $match) ? $match[1] : null;
    return $title;
}
// get web page title
echo 'Title: ' . getTitle('http://www.w3schools.com/php/');

// Output:
// Title: PHP 5 Tutorial
*/
$link=$_POST['link'];
function fetch_og($url)
{
    $data = file_get_contents($url);
    $dom = new DomDocument;
    @$dom->loadHTML($data);

    $xpath = new DOMXPath($dom);
    # query metatags dengan prefix og
    $metas = $xpath->query('//*/meta[starts-with(@property, \'og:\')]');

    $og = array();

    foreach($metas as $meta){
        # ambil nama properti tanpa menyertakan og
        $property = str_replace('og:', '', $meta->getAttribute('property'));
        # ambil konten dari properti tersebut
        $content = $meta->getAttribute('content');
        $og[$property] = $content;
    }

    return $og;
}

# Cara penggunaan, cukup masukan url
$og = fetch_og($link);

echo $og['title'];
echo "<hr>";

echo "<h1>Data Facebook instagram.com</h1>";
foreach ($og as $key => $value) {
    echo "<strong>$key:</strong> ".$value;
    echo "<br>";
}
echo "<a href='$og[image]' download>
  <img border='0' src='$og[image]' alt='instagram' width='104' height='142'>
</a>";
echo "<a href='$og[image]' download>
  <img border='0' src='$og[video]' alt='instagram' width='104' height='142'>
</a>";
?>
