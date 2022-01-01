<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>Verbos</title>
    <link rel="shortcut icon" href="favicon.png" type="image/png">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div>
        <div id="container">
            <div class="v0-verb"><span id="v0"></span></div>
            <div class="trans-verb"><span id="trans"></span></div>
            <div class="curr-tense"><span id="curr-tense"></span></div>
            <div class="buttons-switch-tense">
                <button class="button button-switch-tense" id="PI1">PI1</button>
                <button class="button button-switch-tense" id="PI2">PI2</button>
                <button class="button button-switch-tense" id="PI3">PI3</button>
                <button class="button button-switch-tense" id="PI4">PI4</button>
                <button class="button button-switch-tense" id="PI5">PI5</button>
            </div>
            <div class="buttons">
                <button class="button" id="new-verb">Новый глагол</button>
            </div>
        </div>
        <div class="footer"><a id="footer"></a></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

    <?php

    $db_host = 'localhost';
    $db_user = 'root';
    $db_password = 'root';
    $db_db = 'verbos';
    $db_port = 3307;

    $mysqli = new mysqli(
        $db_host,
        $db_user,
        $db_password,
        $db_db,
        $db_port,
    );

    $mysqli->set_charset("utf8");

    $query = "SELECT * FROM table_name";
    $result = mysqli_query($mysqli, $query);
    $stack = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        array_push($stack, $row);
    }
    $theArray = json_encode($stack);
    mysqli_close($mysqli);
    ?>

    <script>
        let verbsArr = <?php echo $theArray ?>;

        let colors = [
            '#c6c3b3',
            '#ccaf9b',
            '#a06b39',
            '#636f44',
            '#204429',
            '#873c1e',
            '#d73d6c',
            '#d57276',
            '#528c83',
            '#d6c2bc',
            '#c0cccc',
            '#65b2c6',
            '#a2d4df',
            '#fd7c84',
            '#025b0e',
            '#9db802',
            '#efca66',
            '#bb99b7',
        ]

        function getVerb() {

            globalThis.randomVerb = getRandomVerb();
            
            $('.v0-verb').animate({
                opacity: 0
            }, 500, function() {
                $(this).animate({
                    opacity: 1
                }, 500);
                $('#v0').text(randomVerb["INFEU"]);
            });

            $('.trans-verb').animate({
                opacity: 0
            }, 500, function() {
                $(this).animate({
                    opacity: 1
                }, 500);
                $('#trans').html(randomVerb["RUS"]);
            });

            $('.curr-tense').animate({
                opacity: 0
            }, 500, function() {
                $(this).animate({
                    opacity: 1
                }, 500);
                $('#curr-tense').text("");
            });

            var color = Math.floor(Math.random() * colors.length);
            $('html body').animate({
                    backgroundColor: colors[color],
                    color: colors[color]
                },
                1000
            );
            $('.button').animate({
                backgroundColor: colors[color]
            }, 1000);
        }

        function getRandomVerb() {
            return verbsArr[Math.floor(Math.random() * verbsArr.length)];
        }

        function getVerbTense(id) {
            console.log(randomVerb[id]);

            $('.curr-tense').animate({
                opacity: 0
            }, 500, function() {
                $(this).animate({
                    opacity: 1
                }, 500);
                $('#curr-tense').text(randomVerb[id]);
            });
        }

        $(document).ready(function() {
            getVerb();
            console.log(verbsArr[0]);
            $('#new-verb').on('click', getVerb);
            $(".button-switch-tense").click(function() {
                var id = this.id;
                getVerbTense(id);
            });

        });
    </script>
</body>

</html>