<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 12/12/17
 * Time: 17:07
 */
$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if($method == 'POST'){
    $requestBody = file_get_contents('php://input');
    $json = json_decode($requestBody);

    $text = $json->result->parameters->text;

    switch ($text) {
        case 'J’aimerais commander le menu Super mix.':
            $speech = " Nous constatons que vous êtes adepte de ce menu. Ne voulez-vous pas tester un autre menu?  Nous vous proposons de découvrir notre best-seller, le roll California Saumon Avocat.";
            break;

        case 'Non, propose moi un menu avec de la viande':
            $speech = "Nous avons sélectionné pour vous deux menus à base de viande: les sushis Boeuf ou poulet snacké et le roll california Chicken caesar.";
            break;

        case 'Ok Google, parle avec Sushi Shop':
            $speech = "Bonjour, que puis-je pour vous?";
            break;

        case 'Quelle est la différence entre sushis et roll?':
            $speech = "Un sushi est une boule de riz surmontée d’une garniture. Un roll est un rouleau de riz avec une algue et une garniture à l’intérieur.";
            break;

        case 'J’opte pour le California Roll.':
            $speech = "Très bon choix. Nous vous recommandons comme accompagnement notre bestseller la soupe miso.";
            break;

        case 'De quoi est composée la soupe miso ?':
            $speech = "L’excellente soupe miso, est composée d'algue wakame,de tofu, de ciboule, et de sauce soja.";
            break;

        case 'Je suis allergique au soja, propose moi un accompagnement sans soja':
            $speech = "Nous vous proposons notre salade de chou parfaite pour accompagner vos sushis.";
            break;

        case 'Quel est le temps de livraison estimé?':
            $speech = "En heure d’affluence, le temps de livraison varie entre 30 et 45 minutes. Dans cette attente, nous vous proposons pour seulement 1 euro de plus de regarder votre film préféré en VOD.";
            break;

        case 'Ok, super merci Sushi Shop':
            $speech = "De rien et bon appétit !";
            break;

        default:
            $speech = "Sorry, I didnt get that. Please ask me something else.";
            break;
    }

    $response = new \stdClass();
    $response->speech = $speech;
    $response->displayText = $speech;
    $response->source = "webhook";
    echo json_encode($response);
}
else
{
    echo "Method not allowed";
}

?>