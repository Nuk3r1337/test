<?php

require "../classes/database.php";
require "../classes/stringHelper.php";

// I denne card generator, kan man se hvordan ingenting er sat, alt får den fra databasen, og på siden vil man bruge "$limit" for at sige hvormange der skal være

class CardGenerator {

    public static function generateCards($limit = false) {

        $database = new Database();

        $sql = "SELECT p.id, p.title, p.content, i.id image_id, i.path, i.type FROM projects p LEFT JOIN projects_images i ON p.id = i.projects_id AND i.type = 1 ORDER BY p.id DESC ";

        $bindable = [];

        if($limit !== false){
            $sql .= "LIMIT ?";
            $bindable[] = $limit;
        }

        $data = $database->query($sql, $bindable)->fetchAssoc();

        //$images = $database->query("SELECT id, path, type FROM projects_images")->fetchAssoc();

        if(sizeof($data) % 3 === 2){

            $data[sizeof($data)] = ["id" => false, "title" => "Placeholder", "content" => "This is a placeholder"];

        } elseif(sizeof($data) % 3 === 1){

            $data[sizeof($data)] = ["id" => false, "title" => "Placeholder", "content" => "This is a placeholder"];
            $data[sizeof($data)] = ["id" => false, "title" => "Placeholder", "content" => "This is a placeholder"];

        }

        for($i = 0; $i < sizeof($data); $i++){

            if($i % 3 === 0){
                echo '<div class="card-deck custom-card-deck">';
            }

            echo self::cardHTML($data[$i]);

            if($i % 3 === 2){
                echo '</div>';
            }

        }

    }

    private static function cardHTML($data){

        $thumbnail = (!isset($data["path"])) ? "assets/placeholderImage.png" : "project_pictures/{$data["path"]}";

        $html = ($data["id"] === false) ? '<div class="card custom-card">' : '<a href="project.php?id='. $data["id"] .'" class="card custom-card">';
            $html .= '<img class="card-img-top" src="'. $thumbnail .'" width="300px" height="200px" alt="Card image cap">';
            $html .= '<div class="card-body">';
                $html .= '<h4 class="card-title">'.$data["title"].'</h4>';
                $html .= '<p class="card-text">'.StringHelper::stringShortener($data["content"],80).'</p>';
            $html .= '</div>';
        $html .= ($data["id"] === false) ? '</div>' : '</a>';

        return $html;

    }
}
