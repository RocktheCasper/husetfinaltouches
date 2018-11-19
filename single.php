<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="MainSingle.css">
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

            <div class="data-info2">
            </div>


            <a class="data-knap" href=""><button>Køb Billet</button></a>



        </article>
    </template>




    </div>


    <script>

        let urlParams = new URLSearchParams(window.location.search);
        let id = urlParams.get("id");

        let dest = document.querySelector(".data-container");

        let jsonFile;



        document.addEventListener("DOMContentLoaded", getJson);

        async function getJson() {

            let myJson = await fetch("http://fuglevik.de/2.%20semester/huset/wordpress/index.php/wp-json/wp/v2/event");

            jsonFile = await myJson.json();
            showEvents();
        }





        function showEvents() {

            let dest = document.querySelector(".data-container"),
                temp = document.querySelector(".temp");



            jsonFile.forEach(eventsAndet => {




                if (eventsAndet.id == id) {


                let klon = temp.cloneNode(true).content;
                /*Tager videoens ID fra et almindeligt youtube-link og sætter ind i et embed-link, så ethvert youtube-link kan indsættes i formularen*/




                klon.querySelector(".data-knap").href = eventsAndet.acf.bestilkob_knap;

                if (eventsAndet.acf.info.length > 1000) {
                klon.querySelector(".data-info").innerHTML = "<p>" + eventsAndet.acf.info.substring(0,eventsAndet.acf.info.length/2) + "</p>";

                klon.querySelector(".data-info2").innerHTML = "<p>" + eventsAndet.acf.info.substring(eventsAndet.acf.info.length/2,eventsAndet.acf.info.length) + "</p>";


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
