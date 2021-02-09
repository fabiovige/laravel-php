@extends('property.master')

@section('content')

    <div class="container my-3">
            <h1>Página Single</h1>

            <?php

            if(!empty($property)) {

                foreach ($property as $prop) {
                ?>
                    <h2>Título do imóvel: <?= $prop->title ?> </h2>

                    <p>Descrição: <?= $prop->description ?></p>

                    <p>Valor de locação: R$ <?= number_format($prop->rental_price, 2, ',', '.')?></p>

                    <p>Valor de venda: R$ <?= number_format($prop->sale_price, 2, ',', '.') ?></p>

                <?php
                }
            }
            ?>

    </div>

@endsection
