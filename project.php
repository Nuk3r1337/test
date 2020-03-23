<?php

require_once "../classes/database.php";

//Så i stedet for dette ville man ligge de to functioner i hver sin fil


class project
{
    public function add($title, $description, $projectFile, $pictures)
    {

        var_dump($projectFile);
        //var_dump($pictures);

        if (isset($projectFile)) {

        }

        if ($projectFile["type"] !== "application/zip") {
            return "Projekt filen er ikke en zip-fil";
        }

        //application/zip
        //image/png
        //image/jpg
        //image/gif
        return true;
    }

    public function generateProject() {

        $html = '<div class="projects-output">';

        $html .= '<h2 class="project-title">'. $this->title .'</h2>';
        $html .= '<hr>';
        $html .= '<div class="row">';
        $html .= '<div class="col-sm-6 project-element">';
        $html .='<h2>Billeder</h2>';
        $html .= $this->generateCarousel();
        $html .= '</div>';
        $html .= '<div class="col-sm-1"></div>';
        $html .= '<div class="col-sm-5 project-element">';
        $html .= '<h2>Projekt Beskrivelse</h2>';
        $html .= '<br>';
        $html .= '<p>' .$this->content. '</p>';
        $html .= '</div>';
        $html .= '</div>';

        $html .= '</div>';

        return $html;
    }

    private function generateCarousel()
    {

        $imageCount = 0;

        if (($count = sizeof($this->images)) > 0) {

            $imageCount = $count;
        }

        $html = '<div id="project-carousel" class="carousel slide gap-from-top" data-ride="carousel">';
        $html .= '<ol class="carousel-indicators">';

        if ($imageCount !== 0) {

            foreach ($this->images as $index => $image) {

                $html .= ($index === 0) ? '<li data-target="#project-carousel" data-slide-to="' . $index . '" class="active"></li>' : '<li data-target="#project-carousel" data-slide-to="' . $index . '"></li>';
            }
        }

        $html .= '</ol>';
        $html .= '<div class="carousel-inner" role="listbox">';

        if ($imageCount !== 0) {

            foreach ($this->images as $index => $image) {

                $html .= ($index === 0) ? '<div class="carousel-item active">' : '<div class="carousel-item">';
                $html .= '<img class="d-block w-100 fill-img" src="project_pictures/' . $image["path"] . '" alt="900x400" style="width: 900px; height: 400px;">';
                $html .= '</div>';
            }

        } else {

            $html .= '<div class="carousel-item active">';
            $html .= '<img class="d-block w-100 fill-img" src="assets/placeholderImage.png" alt="900x400" style="width: 900px; height: 400px;">';
            $html .= '</div>';
        }

        $html .= '</div>';
        $html .= '<a class="carousel-control-prev" href="#project-carousel" role="button" data-slide="prev">';
        $html .= '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
        $html .= '<span class="sr-only">Previous</span>';
        $html .= '</a>';
        $html .= '<a class="carousel-control-next" href="#project-carousel" role="button" data-slide="next">';
        $html .= '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
        $html .= '<span class="sr-only">Next</span>';
        $html .= '</a>';
        $html .= '</div>';

        return $html;

    }

}
