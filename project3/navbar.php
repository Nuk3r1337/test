<?php

class Navbar
{
    public static function build(){

        $loginStatus = isset($_SESSION["LOGIN_STATUS"]);

        $page = substr($_SERVER["PHP_SELF"], 1);

        $leftContent = ["Hjem"=>"index.php"];

        if($loginStatus){

            $leftContent = array_merge($leftContent, ["Data"=>"data.php", "Graf"=>"graf.php"]);
        }

        $navbar = '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">';
            $navbar .= '<a class="navbar-brand" href="/skomager_john/">Skomager</a>';
            $navbar .= '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">';
                $navbar .= '<span class="navbar-toggler-icon"></span>';
            $navbar .= '</button>';
            $navbar .= '<div class="collapse navbar-collapse" id="navbarSupportedContent">';
                $navbar .= '<ul class="navbar-nav mr-auto">';

                    foreach($leftContent as $key => $value){

                        if($page === $value || ( $page === "index.php" && $value === "/")){

                            $navbar .= '<li class="nav-item active">';

                        } else{

                            $navbar .= '<li class="nav-item">';
                        }

                            $navbar .= '<a class="nav-link" href="/skomager_john/'. $value .'">'. $key .'</a>';
                        $navbar .= '</li>';
                    }

                $navbar .= '</ul>';

                $navbar .= self::selectRightContent($loginStatus);

            $navbar .= '</div>';
        $navbar .= '</nav>';

        return $navbar;
    }

    private static function selectRightContent($loginStatus){

        if($loginStatus) {

            $html = '<ul class="navbar-nav ml-auto">';
                $html .= '<li class="nav-item active">';
                    $html .= '<a class="nav-link">' . $_SESSION["USERNAME"] . '</a>';
                $html .= '</li>';
                $html .= '<li class="nav-item">';
                    $html .= '<a class="nav-link" href="helper/logout.php">Log ud</a>';
                $html .= '</li>';
            $html .= '</ul>';

        } else {

            $html = '<form method="post">';
                $html .= '<ul class="navbar-nav ml-auto">';
                    $html .= '<li class="nav-item">';
                        $html .= '<input class="form-control form-control-sm" type="text" name="username" placeholder="Brugernavn" required="required">';
                    $html .= '</li>';
                    $html .= '<li class="nav-item">';
                        $html .= '<input class="form-control form-control-sm" type="password" name="password" placeholder="Kodeord" required="required">';
                    $html .= '</li>';
                    $html .= '<li class="nav-item">';
                        $html .= '<input type="submit" class="btn btn-primary btn-sm" name="login" value="Log ind">';
                    $html .= '</li>';
                $html .= '</ul>';
            $html .= '</form>';

        }

        return $html;
    }
}
