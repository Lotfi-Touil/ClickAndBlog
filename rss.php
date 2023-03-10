<?php
require_once('connexion.php');
Connexion::initConnexion();

class RssFeed extends Connexion
{
    public static function affichageRss()
    {
        $selectPrep = self::$bdd->prepare('SELECT * FROM article WHERE etat=TRUE ORDER BY id DESC LIMIT 20');
        $selectPrep->execute();
        header("Content-type: text/xml");
        echo "<?xml version='1.0' encoding='UTF-8'?>
 <rss xmlns:content='http://purl.org/rss/1.0/modules/content/' version='2.0'>
 <channel>
 <title> Click&amp;Blog | RSS</title>
 <link>/</link>
 <description>Cloud RSS</description>
 <language>en-us</language>";

        foreach ($selectPrep->fetchall() as $row) {
            $title = $row["titre"];
            $link = "index.php?module=mod_article&amp;action=detail&amp;id=" . $row["id"];
            $content = utf8_encode(html_entity_decode($row["contenu"]));
            echo "<item xmlns=\"http://www.w3.org/1999/html\">
   <title>$title</title>
   <link>
    <loc>
   $link
   </loc>
   </link>
   <content:encoded>$content</content:encoded>
   </item>";
        }
        echo "</channel></rss>";
    }
}

RssFeed::affichageRss();
?>