<!DOCTYPE html>
<html>
    <head>
        <title>Anketa - opće informacije</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link href="css/style.css" rel="stylesheet"/>
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <script src="javascript/jquery.min.js"></script>
        <script src="javascript/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="jumbotron">
            <h3 class="boldtext">ISPITIVANJE PONAŠANJA I ZNANJA KORISNIKA O PITANJIMA KOJA SE TIČU INFORMACIJSKE SIGURNOSTI</h3>
            <?php
                require_once 'init.php';
                function checkType($t) {
                    if($t == 'ucenici' || $t == 'studenti' || $t == 'zaposlenici') {
                        return true;
                    } else {
                        return false;
                    }
                }
                function checkFirm($t, $f) {
                    switch($t) {
                        case 'ucenici':
                            if(in_array($f, $GLOBALS['config'][3])) {
                                $_SESSION['order'] = $GLOBALS['config'][0];
                                $_SESSION['table_name'] = "ucenici_" . $f;
                                $_SESSION['konekcija'] = "konekcija_ucenici.php";
                                return true;
                            } else {
                                return false;
                            }
                        break;
                        case 'studenti':
                            if(in_array($f, $GLOBALS['config'][4])) {
                                $_SESSION['order'] = $GLOBALS['config'][1];
                                $_SESSION['table_name'] = "studenti_" . $f;
                                $_SESSION['konekcija'] = "konekcija_studenti.php";
                                return true;
                            } else {
                                return false;
                            }
                        break;
                        case 'zaposlenici':
                            if(in_array($f, $GLOBALS['config'][5])) {
                                $_SESSION['order'] = $GLOBALS['config'][2];
                                $_SESSION['table_name'] = "djelatnici_" . $f;
                                $_SESSION['konekcija'] = "konekcija_djelatnici.php";
                                return true;
                            } else {
                                return false;
                            }
                        break;
                    }
                }
				function test_input($data) {
					$data = trim($data);
					$data = stripslashes($data);
					$data = htmlspecialchars($data);
					return $data;
				}
                if($_SERVER['REQUEST_METHOD'] == "GET") {
                    if(empty($_GET['tip']) || empty($_GET['ustanova'])) {
                        echo '<p>Niste upisali (kliknuli) ispravnu adresu! Molimo Vas da provjerite ispravnost adrese.</p>';
                    } else {
                        $qtype = test_input($_GET['tip']);
                        $qinstitution = test_input($_GET['ustanova']);
                        $qtc = checkType($qtype);
                        $qic = checkFirm($qtype, $qinstitution);
                        if($qtc && $qic) {
                            ?>
                                <p class="j">
                                    Poštovani,
                                    <br/><br/>
                                    Centar za nestalu i zlostavljanu djecu Osijek u partnerstvu sa Sveučilištem J.J. Strossmayera u Osijeku, 
                                    Fakultetom za odgojne i obrazovne znanosti, Gradom Osijekom i Vipnetom provodi veliki 
                                    nacionalni projekt „Safer Internet Centre Croatia: Making internet a good and safe place” (2015-HR-IA-0013).
                                </p>
                                <p class="j">
                                    <span class="boldtext">Opći cilj projekta</span> je održavanje Centra za sigurniji internet Hrvatske kako bi se i dalje postavile i
                                    proširile nacionalne platforme za pokretanje niza usluga za sigurniji Internet. <span class="boldtext">Specifični ciljevi
                                    projekta su</span>: daljnji razvoj i promocija centra za podršku i informiranje djece, roditelja, učitelja i
                                    drugih koji rade s djecom o boljoj i sigurnijoj upotrebi interneta; poboljšanje Helpline usluge za
                                    prijavljivanje i pružanje pomoći vezano uz štetne kontakte (grooming), ponašanja (internetsko
                                    zlostavljanje-cyberbullying) i sadržaje, daljnje održavanje Hotline usluge za primanje i izvještavanje te
                                    prikupljanje podataka o protuzakonitom online seksualnom zlostavljanju djeteta.
                                </p>
                                <p class="j">
                                    Ovim dijelom projekta na nacionalnoj razini želimo prikupiti podatke vezane uz navike korisnika
                                    različitih informacijsko-komunikacijskih računalnih sustava. U tu svrhu zamolili bismo vas da svojim
                                    sudjelovanjem doprinesete ovom važnom projektu. Glavni cilj istraživanja je ispitati vaša znanja i
                                    ponašanja prilikom korištenja računala i Interneta.
                                </p>
                                <p>
                                    Detalje o projektu možete pronaći <a href="http://www.csi.hr" target="_blank" data-toggle="tooltip" title="Službene stranice projekta">ovdje</a>.
                                </p>
                                <p class="j">
                                    Ukoliko kliknete na nastavak za popunjavanje ANONIMNOG upitnika smatrat ćemo da ste dobrovoljno pristali na suradnju.
                                </p>
                                <p>
                                    Molimo Vas da se ne pokušavate vraćati na prethodni dokument (back) tijekom popunjavanja ankete.
                                </p>
                                <hr>
                                <p>
                                    This work is financed by the Croatian Government Office for Cooperation with NGOs and co-financed by the European Union’s Connecting Europe Facility, 
                                    under project named “Safer Internet Centre Croatia: Making internet a good and safe place”, Agreement Number: INEA/CEF/ICT/A2015/115320
                                </p>
                                <p>
                                    The sole responsibility of this research lies with the authors. The European Union is not responsible for any use that may be made of the information contained therein.
                                </p>
                            </div>
                            <form method="POST" action="<?php echo reset($_SESSION['order']); ?>" class="pokreni">
                                <input type="submit" value="Kreni" name="kreni" class="btn btn-primary" data-toggle="tooltip" title="Pokretanje ankete">
                            </form>
                        </div>
                        <script>
                            $(document).ready(function(){
                                $('[data-toggle="tooltip"]').tooltip({
                                    trigger : 'hover'
                                });
                            });
                        </script>
                            <?php
                        } else {
                            echo '<p>Niste upisali (kliknuli) ispravnu adresu! Molimo Vas da provjerite ispravnost adrese.</p>';
                        }
                    }
                } else {
                    echo '<p>Niste upisali (kliknuli) ispravnu adresu! Molimo Vas da provjerite ispravnost adrese.</p>';
                }        
            ?>
    </body>
</html>