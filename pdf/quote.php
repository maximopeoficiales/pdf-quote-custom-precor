<?php

/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if (!defined('ABSPATH')) {
	exit;
} // Exit if accessed directly
require(plugin_dir_path(__FILE__) . '../wc-orders-custom/OrderCustom.php');
// require("./wc-orders-custom/OrderCustom.php");
$order = new OrderCustom($order_id);
$data = $order->getOrderData();
$currentOrder = $order->getOrder();
$example = $order->getOrder()->get_billing_address_1();

// codigo para logo
$logo_url = get_option('ywraq_pdf_logo');
$logo_attachment_id = apply_filters('yith_pdf_logo_id', get_option('ywraq_pdf_logo-yith-attachment-id'));
if (!$logo_attachment_id && $logo_url) {
	$logo_attachment_id = attachment_url_to_postid($logo_url);
}

$logo = $logo_attachment_id ? get_attached_file($logo_attachment_id) : $logo_url;
// fin de logo
?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
	<style type=" text/css">
		html {
			font-size: 10px;
		}

		p {
			margin-top: 0;
			margin-bottom: 0;

		}

		.text-8 {
			font-size: 8px !important;
		}
	</style>
</head>

<body>
	<div>
		<div class="p-2">
			<img src="<?php echo esc_url($logo); ?>" class="rounded-lg" style="max-width: 150px;">
			<div class="text-uppercase float-right">
				<p class="border p-2 border-dark my-1"><b>Cotizacion:</b> <?= $order_id ?></p>
				<p class="border p-2 border-dark my-1"><b>Fecha:</b> <?= $data["date_created"] ?></p>
			</div>
		</div>

	</div>
	<div class="my-2 border text-uppercase text-sm p-2  border-dark">
		<p class=""><b>CLIENTE:</b> <?= $data["customer_id_cli"] ?> <?= $currentOrder->get_billing_first_name() ?></p>
		<p class=""><b>DIRECCION:</b> <?= $currentOrder->get_billing_address_1() ?></p>
		<p class=""><b>TELEFONO:</b> <?= $currentOrder->get_billing_phone() ?></p>
		<p class=""><b>ATENCION:</b> <?= $data["customer_nombeje"] ?></p>
	</div>
	<table class="table table-bordered text-uppercase my-1 w-100">
		<thead class="thead-light  text-center">
			<tr>
				<th class="text-8">ITEM</th>
				<th class="text-8">CANT.</th>
				<th class="text-8">CODIGO</th>
				<th class="text-8" style="width: 25%;">DESCRIPCION</th>
				<th class="text-8">UND.</th>
				<th class="text-8">PZAS</th>
				<th class="text-8">
					PESO.PZA KG
				</th>
				<th class="text-8">P.LISTA USD</th>
				<th class="text-8">VAL.VTA USD</th>
				<th class="text-8">TOTAL USD</th>
				<th class="text-8">PESO.TOT KG</th>
			</tr>
		</thead>
		<tbody class="text-8">
			<tr>
				<td scope="row" class="text-8 text-center">0010</td>
				<td class="text-8 text-center">336.000</td>
				<td class="text-8 text-center">403036</td>
				<td class="text-8 text-left">PERFIL PARANTE 64 X 38 X 0.45 X 3 GALV</td>
				<td class="text-8 text-center">PAQ</td>
				<td class="text-8 text-right">2,688</td>
				<td class="text-8 text-right">12.63</td>
				<td class="text-8 text-right">2.49</td>
				<td class="text-8 text-right">1.57</td>
				<td class="text-8 text-right">4,216.66</td>
				<td class="text-8 text-right">4,244.35</td>
			</tr>
		</tbody>
	</table>
	<div class="p-2 my-2">
		<h6 class="text-bold">Observaciones</h6>
		<div class="text-uppercase float-right">
			<p class="border p-2 border-dark my-1"><b>PESO TOT KG:</b> 13,874.69</p>
			<p class="border p-2 border-dark my-1"><b>Subtotal:</b> 13,997.49</p>
			<p class="border p-2 border-dark my-1"><b>IGV (18%):</b> 2,519.55</p>
			<p class="border p-2 border-dark my-1"><b>PERC.( %):</b> 0.00</p>
			<p class="border p-2 border-dark my-1"><b>TOTAL USD:</b> 16,517.04</p>
		</div>
	</div>

</body>

</html>