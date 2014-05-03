<?php


namespace ImagickDemo\ImagickDraw;


use ImagickDemo\Navigation\ActiveNav;

class ImagickDrawNav implements ActiveNav {
    
    private $currentExample;

    private $imagickDrawExamples = array(
        'affine',
        'annotation' => 'setFontSize',
        'arc',
        'bezier',
        'circle',
            //'clear',
            //'color',
            //'comment',
        'composite',
            //'destroy',
        'ellipse',
        //    'getClipPath',
        //    'getClipRule',
        //    'getClipUnits',
        //    'getFillColor',
        //    'getFillOpacity',
        //    'getFillRule',
        //    'getFont',
        //    'getFontFamily',
        //    'getFontSize',
        //    'getFontStyle',
        //    'getFontWeight',
        //    'getGravity',
        //    'getStrokeAntialias',
        //    'getStrokeColor',
        //    'getStrokeDashArray',
        //    'getStrokeDashOffset',
        //    'getStrokeLineCap',
        //    'getStrokeLineJoin',
        //    'getStrokeMiterLimit',
        //    'getStrokeOpacity',
        //    'getStrokeWidth',
        //    'getTextAlignment',
        //    'getTextAntialias',
        //    'getTextDecoration',
        //    'getTextEncoding',
        //    'getTextUnderColor',
        //    'getVectorGraphics',
        'line',
            //'matte', dont know how it works
//        'pathClose' => 'pathStart',
//        'pathCurveToAbsolute',
//        'pathCurveToQuadraticBezierAbsolute',
//        'pathCurveToQuadraticBezierRelative',
//        'pathCurveToQuadraticBezierSmoothAbsolute',
//        'pathCurveToQuadraticBezierSmoothRelative',
//        'pathCurveToRelative',
//        'pathCurveToSmoothAbsolute',
//        'pathCurveToSmoothRelative',
//        'pathEllipticArcAbsolute',
//        'pathEllipticArcRelative',
//        'pathFinish',
//        'pathLineToAbsolute',
//        'pathLineToHorizontalAbsolute',
//        'pathLineToHorizontalRelative',
//        'pathLineToRelative',
//        //'pathLineToVerticalAbsolute',
//        //'pathLineToVerticalRelative',
//        'pathMoveToAbsolute',
//        'pathMoveToRelative',
        'pathStart',
        'point',
        'polygon',
        'polyline',
        'pop' => 'push',
        'popClipPath' => 'setClipPath',
            //'popDefs', DrawPushDefs() indicates that commands up to a terminating DrawPopDefs() command create named elements (e.g. clip-paths, textures, etc.) which may safely be processed earlier for the sake of efficiency.
        'popPattern' => 'pushPattern',
        'push',
        'pushClipPath' => 'setClipPath',
            // 'pushDefs', DrawPushDefs() indicates that commands up to a terminating DrawPopDefs() command create named elements (e.g. clip-paths, textures, etc.) which may safely be processed earlier for the sake of efficiency.
        'pushPattern',
        'rectangle',
            //'render', no idea what this does
        'rotate',
        'roundRectangle',
        'scale',
        'setClipPath',
        'setClipRule',
        'setClipUnits',
        'setFillAlpha',
        'setFillColor',
        'setFillOpacity',
        'setFillPatternURL' => 'pushPattern',
        'setFillRule',
        'setFillRule2',
        'setFont',
            //'setFontFamily',
        'setFontSize',
            //'setFontStretch', Does nothing?
        'setFontStyle',
        'setFontWeight',
        'setGravity',
        'setStrokeAlpha',
        'setStrokeAntialias',
        'setStrokeColor',
        'setStrokeDashArray',
        'setStrokeDashOffset',
        'setStrokeLineCap',
        'setStrokeLineJoin',
        'setStrokeMiterLimit',
        'setStrokeOpacity',
            //'setStrokePatternURL',
        'setStrokeWidth',
        'setTextAlignment',
        'setTextAntialias',
        'setTextDecoration',
            //'setTextEncoding',
        'setTextUnderColor',
        'setVectorGraphics', // seems broken
            // 'setViewbox', no idea what this does
        'skewX',
        'skewY',
        'translate',
    );

    function display($example, \Auryn\Provider $provider) {
        ////$imageURL = '\ImagickDemo\ImagickDraw\'.$example;
        $this->currentExample = $example;
        $classname = 'ImagickDemo\ImagickDraw\\' . $example;
        $provider->alias(\ImagickDemo\Example::class, $classname);
        $provider->alias(\ImagickDemo\Navigation\ActiveNav::class, get_class($this));
        $provider->share($this);
    }

    function displayIndex(\Auryn\Provider $provider) {
        $provider->alias(\ImagickDemo\Navigation\ActiveNav::class, get_class($this));
        $provider->share($this);
    }


    function renderImage($example, \Auryn\Provider $provider) {
        $classname = '\ImagickDemo\ImagickDraw\\' . $example;
        $provider->alias(\ImagickDemo\Example::class, $classname);
        $provider->execute([\ImagickDemo\ImageExampleCache::class, 'renderImageSafe']);
        //$provider->execute([$classname, 'renderImage']);
    }

    function renderTitle() {
        if ($this->currentExample) {
            return $this->currentExample;
        }
        return 'ImagickDraw';
    }

    function renderPreviousButton() {
        $previous = getPrevious($this->imagickDrawExamples, $this->currentExample);

        if ($previous) {
            return "<a href='/ImagickDraw/$previous'>
            <button type='button' class='btn btn-primary'>
             <span class='glyphicon glyphicon-arrow-left'></span> $previous
            </button>
            </a>";
        }

        return "";
    }

    function renderNextButton() {
        $next = getNext($this->imagickDrawExamples, $this->currentExample);

        if ($next) {
            echo "<a href='/ImagickDraw/$next'>
            <button type='button' class='btn btn-primary'>
            $next <span class='glyphicon  glyphicon-arrow-right'></span>
            </button>
            </a>";
        }

        return "";
    }

    function renderNav() {
        echo "<ul class='nav nav-sidebar smallPadding'>";
        foreach ($this->imagickDrawExamples as $key => $imagickDrawExample) {
            echo "<li>";
            if ($key === intval($key)){
                echo "<a href='/ImagickDraw/$imagickDrawExample'>".$imagickDrawExample."</a>";
            }
            else{
                echo "<a href='/ImagickDraw/$imagickDrawExample'>".$key."</a>";
            }
            echo "</li>";
        }
        echo "</ul>";
    }
}

 