<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content site-error">
	<aside class="two-side pull-left">
		<svg width="380px" height="500px" viewBox="0 0 837 1045" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
			<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
				<?php
					if (strpos($name,'404')){
						echo '<path d="M353,9 L626.664028,170 L626.664028,487 L353,642 L79.3359724,487 L79.3359724,170 L353,9 Z" id="Polygon-1" stroke="#007FB2" stroke-width="6" sketch:type="MSShapeGroup"></path>
						<path d="M78.5,529 L147,569.186414 L147,648.311216 L78.5,687 L10,648.311216 L10,569.186414 L78.5,529 Z" id="Polygon-2" stroke="#EF4A5B" stroke-width="6" sketch:type="MSShapeGroup"></path>
						<path d="M773,186 L827,217.538705 L827,279.636651 L773,310 L719,279.636651 L719,217.538705 L773,186 Z" id="Polygon-3" stroke="#795D9C" stroke-width="6" sketch:type="MSShapeGroup"></path>
						<path d="M639,529 L773,607.846761 L773,763.091627 L639,839 L505,763.091627 L505,607.846761 L639,529 Z" id="Polygon-4" stroke="#F2773F" stroke-width="6" sketch:type="MSShapeGroup"></path>
						<path d="M281,801 L383,861.025276 L383,979.21169 L281,1037 L179,979.21169 L179,861.025276 L281,801 Z" id="Polygon-5" stroke="#36B455" stroke-width="6" sketch:type="MSShapeGroup"></path>';
					}
					else{
						echo '<path d="M353,9 L626.664028,170 L626.664028,487 L353,642 L79.3359724,487 L79.3359724,170 L353,9 Z" id="Polygon-1" stroke="RED" stroke-width="6" sketch:type="MSShapeGroup"></path>
						<path d="M78.5,529 L147,569.186414 L147,648.311216 L78.5,687 L10,648.311216 L10,569.186414 L78.5,529 Z" id="Polygon-2" stroke="#36B455" stroke-width="6" sketch:type="MSShapeGroup"></path>
						<path d="M773,186 L827,217.538705 L827,279.636651 L773,310 L719,279.636651 L719,217.538705 L773,186 Z" id="Polygon-3" stroke="#007FB2" stroke-width="6" sketch:type="MSShapeGroup"></path>
						<path d="M639,529 L773,607.846761 L773,763.091627 L639,839 L505,763.091627 L505,607.846761 L639,529 Z" id="Polygon-4" stroke="#795D9C" stroke-width="6" sketch:type="MSShapeGroup"></path>
						<path d="M281,801 L383,861.025276 L383,979.21169 L281,1037 L179,979.21169 L179,861.025276 L281,801 Z" id="Polygon-5" stroke="#F2773F" stroke-width="6" sketch:type="MSShapeGroup"></path>';
					}
				?>
			</g>
		</svg>
	</aside>
	<aside class="two-side pull-right">
		<div class="notfound">
			<div class="notfound-404">
				<?php
					if (strpos($name,'404'))
						echo "<h1>404</h1>";
					else
						echo "<h1>403</h1>";
				?>
			</div>
			<?php
				if (strpos($name,'404'))
					echo '<h2><i class="fas fa-exclamation-triangle text-warning"></i> Oops, '.nl2br(Html::encode($message)).'</h2>';
				else
					echo '<h2><i class="fas fa-exclamation-circle text-danger"></i> Oops, '.nl2br(Html::encode($message)).'</h2>';
			?>
			<a href="#" onclick="history.back(-1)"><span class="arrow-l"></span>Back</a><?= Html::a('Dashboard<span class="arrow-r"></span>', ['/site/index'], ['style'=>'margin-left:20px'])?>
		</div>
	</aside>
</section>