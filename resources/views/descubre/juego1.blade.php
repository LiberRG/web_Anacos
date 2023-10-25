@extends('layouts.app')

@section('page-class', 'descubreJuego1')

@section('content')
{{-- Página de resultados de búsqueda, con el mosaico de sesiones.--}}
@php($dataJuego1 = [
["img/juego1/1.jpg",
"img/juego1/1.jpg",
"Esta es una pequeña descripcion 1"],

["img/juego1/2.jpg",
"img/juego1/2.jpg",
"Esta es una pequeña descripcion 2"],

["img/juego1/3.jpg",
"img/juego1/3.jpg",
"Esta es una pequeña descripcion 3"],

["img/juego1/4.jpg",
"img/juego1/4.jpg",
"Esta es una pequeña descripcion 4"],])

<div class="flex justify-between gap-x-3 container py-5 h-full">
    <div id="tablero" class="grow flex items-center flex-wrap">
    @foreach ($dataJuego1 as $data)
    <x-card></x-card>
    <x-card></x-card>
    @endforeach

    </div>
    <div class="flex flex-col gap-y-3 max-w-[25%]">
        <div class="flex h-full w-full">
            <div class="w-full h-5/6 bg-azul-claro flex items-end rounded-md my-auto p-3">
                <div id="text-description"></div>
                <div id="name-collection" class="text-blanco">
                    <h3 class="h3">Descubre</h3>
                    <h2 class="h2">Combarro</h2>
                </div>
            </div>
        </div>
        <button type="button" class="boton my-5 nuevo-juego min-w-full" onclick="dashboard()">
            Jugar de nuevo
        </button>
    </div>
</div>

<script>
    var selects = []
    var description = []
    var DATA_JUEGO = <?=json_encode($dataJuego1);?>;
    var data = new Array
    window.addEventListener("DOMContentLoaded", dashboard(), false);

    function dashboard() {

        selects = []
        document.getElementById("text-description").innerHTML = ""
        document.getElementById("name-collection").setAttribute("style", "diplay:inline")
        
        for (let i = 0; i < DATA_JUEGO.length; i++) {
            for (let j = 0; j < DATA_JUEGO[i].length; j++) {
                const element = DATA_JUEGO[i][j];
                if(j == (DATA_JUEGO[i].length-1)){
                    description.push(element)
                } else {
                    id= j+"-"+i
                    data.push({id: id, img: element})
                }                
            }            
        }
        if(data.length>0){data.sort((img) => Math.random() - 0.8, )}
        let tablero = document.getElementById("tablero");
        cards = tablero.children
        for (let i = 0; i < data.length; i++) {
            card= cards[i]
            if (card.querySelector('.card').style.transform != null) {
                card.querySelector('.card').style.transform = null
            }
            console.log('hola')
            card.addEventListener('click', ()=>{selectCard( data[i].id )})
            card.querySelector('.card').id="card"+data[i].id
            card.querySelector('img').src = data[i].img      
       
    }
    }

    function selectCard(i) {
        let selectCard = document.getElementById("card" + i)

        if (selectCard.style.transform != "rotateY(180deg)") {
            selectCard.style.transform = "rotateY(180deg)"
            selects.push(i)
        }
        if (selects.length == 2) {
            unselect(selects)
            selects = []
        }
    }

    function unselect(selects) {
        setTimeout(() => {

            if (selects[0].slice(-1) != selects[1].slice(-1)) {
                let card1 = document.getElementById("card" + selects[0])
                let card2 = document.getElementById("card" + selects[1])
                card1.style.transform = "rotateY(0deg)"
                card2.style.transform = "rotateY(0deg)"
            } else {
                document.getElementById("name-collection").setAttribute("style", "display:none")
                document.getElementById("text-description").innerHTML = description[selects[0].slice(-1)]
            }

        }, 800);
    }
</script>


</body>

</html>

@endsection