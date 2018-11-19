<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="MainEvent.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <title>Indhold</title>
</head>



<body>
    <div class="container">



        <div class="sideImage">

        </div>

        <div class="MainContent">

            <?php include "header.html";?>


        <div class="sorting">

            <button class="menu-type" data-type="alle">Alle</button>
            <button class="menu-type" data-type="Teater">Teater</button>
            <button class="menu-type" data-type="Fest">Fest</button>
            <button class="menu-type" data-type="Musik">Musik</button>
            <button class="menu-type" data-type="Film">Film</button>
            <button class="menu-type" data-type="Andet">Andet</button>
        </div>

        <main>
            <section class="data-container">
            </section>

        </main>

        <?php include "footer.html";?>

    </div>





        <template class="temp">

        <article class="eventContainer">

            <div class="data-media">
                <div class="data-image">
                    <div class="data-billede" style="">

                    </div>
                </div>
            </div>
            <div class="data-info">
            </div>

            <p class="data-dato"></p>
            <p class="data-tid"></p>
            <p class="data-type"></p>
            <p class="data-overskrift"></p>
            <p class="data-sted"></p>
            <p class="data-pris"></p>
            <a class="data-knap" href=""><button>Køb Billet</button></a>



        </article>
    </template>




    </div>


    <script>
        let dest = document.querySelector(".data-container");

        let jsonFile;

        let Filter = "alle";

        document.addEventListener("DOMContentLoaded", getJson);

        async function getJson() {

            let myJson = await fetch("http://fuglevik.de/2.%20semester/huset/wordpress/index.php/wp-json/wp/v2/event");

            jsonFile = await myJson.json();
            showEvents();
        }

        document.querySelectorAll(".menu-type").forEach(knap => {
            knap.addEventListener("click", filtering)

        });

        function filtering() {

            dest.textContent = "";
            Filter = this.getAttribute("data-type");
            showEvents();

        }



        function showEvents() {

            let dest = document.querySelector(".data-container"),
                temp = document.querySelector(".temp");



            jsonFile.forEach(eventsAndet => {




                if (eventsAndet.acf.type == Filter || Filter == "alle") {


                let klon = temp.cloneNode(true).content;
                /*Tager videoens ID fra et almindeligt youtube-link og sætter ind i et embed-link, så ethvert youtube-link kan indsættes i formularen*/


                klon.querySelector(".eventContainer").addEventListener("click", () => {
                    window.location.href = "single.php?id=" + eventsAndet.id;
                });







                klon.querySelector(".data-dato").innerHTML =  eventsAndet.acf.dato;
                klon.querySelector(".data-overskrift").innerHTML = eventsAndet.acf.overskrift;
                klon.querySelector(".data-tid").innerHTML = "kl: " + eventsAndet.acf.tidspunkt;
                klon.querySelector(".data-type").innerHTML = eventsAndet.acf.type;
                klon.querySelector(".data-sted").innerHTML = "Eventet foregår i " + eventsAndet.acf.sted;
                klon.querySelector(".data-pris").innerHTML = "Pris: " + eventsAndet.acf.pris + "kr.";
                klon.querySelector(".data-knap").href = eventsAndet.acf.bestilkob_knap;

                if (eventsAndet.acf.info.length > 200) {
                klon.querySelector(".data-info").innerHTML = "<p>" + eventsAndet.acf.info.substring(0,200) + "..." + "</p>";
                } else {
                    klon.querySelector(".data-info").innerHTML = "<p>" + eventsAndet.acf.info + "</p>";
                }

                klon.querySelector(".data-billede").style = "background-image: url(" + eventsAndet.acf.billede + ")";


                dest.appendChild(klon);
                }
            })

        }



    </script>

</body>
</html>
