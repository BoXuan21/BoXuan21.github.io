<?php
if (!isset ($_SESSION)) {
    session_start();
}
error_reporting(E_ALL); //Fehlermeldungen aktivieren
ini_set('display_errors', 'On'); //Zusatzeinstellung: Error wird ausgegeben

include '../includes/navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<?php include '../includes/header.php' ?>
<body>
    <main>
        </section> 
        <section id="sell">
        <h1>Who are we?</h1>
        <div class="about-content">
        <p>
            Willkommen bei SmartBuy - Ihrem Ziel für einzigartige Einkaufserlebnisse und erstklassige Produkte!
            Bei SmartBuy verstehen wir die Bedeutung von Komfort, Qualität und Stil. Unser Ziel ist es, unseren Kunden ein nahtloses Einkaufserlebnis zu bieten, das von einer sorgfältig kuratierten Auswahl an Produkten bis hin zu einem erstklassigen Kundenservice reicht.
            Unsere Plattform bietet eine breite Palette von Produkten aus verschiedenen Kategorien, darunter Mode, Elektronik, Haushaltswaren, Schönheitsprodukte und vieles mehr. Jedes Produkt, das wir anbieten, wurde sorgfältig ausgewählt, um höchsten Qualitätsstandards gerecht zu werden und gleichzeitig aktuellen Trends und Innovationen zu entsprechen.
            Unser engagiertes Team arbeitet unermüdlich daran, sicherzustellen, dass Ihre Einkaufserfahrung reibungslos verläuft. Wir stehen Ihnen jederzeit zur Verfügung, um Fragen zu beantworten, Probleme zu lösen und sicherzustellen, dass Sie mit Ihrem Einkauf bei SmartBuy vollkommen zufrieden sind.
            Bei SmartBuy glauben wir an die Kraft des Einkaufens, um Lebensfreude zu schaffen und die Bedürfnisse unserer Kunden zu erfüllen. Treten Sie ein in unsere Welt des stilvollen Einkaufens und entdecken Sie, was SmartBuy für Sie bereithält.
        </p>
        </div>
        <!-- Add more sections here for Products, About Us, and Contact -->
    </section>
    </main>
    <footer>
        <p>Shopping Site © 2024</p>
    </footer>
    <script src="jscript/script.js"></script>
</body>
</html>
