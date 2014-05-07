<?php


namespace ImagickDemo\ImagickDraw;

class setStrokeOpacity extends ImagickDrawExample {

    function renderDescription() {
        return "";
    }

    function renderImage() {
//Create a ImagickDraw object to draw into.
        $draw = new \ImagickDraw();


        $draw->setStrokeWidth(1);

        $strokeColor = new \ImagickPixel($this->strokeColor);
        $fillColor = new \ImagickPixel($this->fillColor);

        $draw->setStrokeColor($strokeColor);
        $draw->setFillColor($fillColor);

        $draw->setStrokeWidth(10);

        $draw->setStrokeOpacity(1);
        $draw->line(100, 80, 400, 125);
        $draw->rectangle(25, 200, 150, 350);


        $draw->setStrokeOpacity(0.5);
        $draw->line(100, 100, 400, 145);
        $draw->rectangle(200, 200, 325, 350);

        $draw->setStrokeOpacity(0.2);
        $draw->line(100, 120, 400, 165);
        $draw->rectangle(375, 200, 500, 350);


//Create an image object which the draw commands can be rendered into
        $image = new \Imagick();
        $image->newImage(550, 400, $this->backgroundColor);
        $image->setImageFormat("png");

//Render the draw commands in the ImagickDraw object 
//into the image.
        $image->drawImage($draw);

//Send the image to the browser
        header("Content-Type: image/png");
        echo $image->getImageBlob();


    }

}
 