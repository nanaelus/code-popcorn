<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MovieSeeder extends Seeder
{
    public function run()
    {
        $data = [

            [
                "title" => "Avengers",
                "release" => "41024",
                "duration" => "143",
                "rating" => "Tous publics",
                "description" => "",
                "slug" => "avengers"
            ],
            [
                "title" => "Harry Potter à l'école des sorciers",
                "release" => "37230",
                "duration" => "152",
                "rating" => "Tous publics",
                "description" => "Orphelin, Harry Potter a été recueilli à contrecœur par son oncle Vernon et sa tante Pétunia, aussi cruels que mesquins, qui n'hésitent pas à le faire dormir dans le placard sous l'escalier. Constamment maltraité, il doit en outre supporter les jérémiades de son cousin Dudley, garçon cupide et archi-gâté par ses parents. De leur côté, Vernon et Pétunia détestent leur neveu dont la présence leur rappelle sans cesse le tempérament imprévisible des parents du garçon et leur mort mystérieuse.",
                "slug" => "harry-potter-a-lecole-des-sorciers"
            ],
            [
                "title" => "Harry Potter et la chambre des secrets",
                "release" => "37594",
                "duration" => "158",
                "rating" => "Tous publics",
                "description" => "Alors que l'oncle Vernon, la tante Pétunia et son cousin Dudley reçoivent d'importants invités à dîner, Harry Potter est contraint de passer la soirée dans sa chambre. Dobby, un elfe, fait alors son apparition. Il lui annonce que de terribles dangers menacent l'école de Poudlard et qu'il ne doit pas y retourner en septembre. Harry refuse de le croire.Mais sitôt la rentrée des classes effectuée, ce dernier entend une voix malveillante. Celle-ci lui dit que la redoutable et légendaire Chambre des secrets est à nouveau ouverte, permettant ainsi à l'héritier de Serpentard de semer le chaos à Poudlard. Les victimes, retrouvées pétrifiées par une force mystérieuse, se succèdent dans les couloirs de l'école, sans que les professeurs - pas même le populaire Gilderoy Lockhart - ne parviennent à endiguer la menace. Aidé de Ron et Hermione, Harry doit agir au plus vite pour sauver Poudlard.",
                "slug" => "harry-potter-et-la-chambre-des-secrets"
            ],
            [
                "title" => "Harry Potter et le Prisonnier d'Azkaban",
                "release" => "38140",
                "duration" => "141",
                "rating" => "Tous publics",
                "description" => "Sirius Black, un dangereux sorcier criminel, s'échappe de la sombre prison d'Azkaban avec un seul et unique but : retrouver Harry Potter, en troisième année à l'école de Poudlard. Selon la légende, Black aurait jadis livré les parents du jeune sorcier à leur assassin, Lord Voldemort, et serait maintenant déterminé à tuer Harry...",
                "slug" => "harry-potter-et-le-prisonnier-dazkaban"
            ],
            [
                "title" => "Harry Potter et la Coupe de Feu",
                "release" => "38686",
                "duration" => "157",
                "rating" => "Tous publics",
                "description" => "La quatrième année à l'école de Poudlard est marquée par le Tournoi des trois sorciers. Les participants sont choisis par la fameuse coupe de feu qui est à l'origine d'un scandale. Elle sélectionne Harry Potter alors qu'il n'a pas l'âge légal requis !",
                "slug" => "harry-potter-et-la-coupe-de-feu"
            ],
            [
                "title" => "Harry Potter et l'Ordre du Phénix",
                "release" => "39274",
                "duration" => "128",
                "rating" => "Tous publics",
                "description" => "Alors qu'il entame sa cinquième année d'études à Poudlard, Harry Potter découvre que la communauté des sorciers ne semble pas croire au retour de Voldemort, convaincue par une campagne de désinformation orchestrée par le Ministre de la Magie Cornelius Fudge. Afin de le maintenir sous surveillance,  L'Armée de Dumbledore, pour leur enseigner l'art de la défense contre les forces du Mal et se préparer à la guerre qui s'annonce...",
                "slug" => "harry-potter-et-lordre-du-phenix"
            ],
            [
                "title" => "Harry Potter et le Prince de sang mêlé",
                "release" => "40009",
                "duration" => "153",
                "rating" => "Tous publics",
                "description" => "L'étau démoniaque de Voldemort se resserre sur l'univers des Moldus et le monde de la sorcellerie. Poudlard a cessé d'être un havre de paix, le danger rode au coeur du château... Mais Dumbledore est plus décidé que jamais à préparer Harry à son combat final, désormais imminent. Ensemble, le vieux maître et le jeune sorcier vont tenter de percer à jour les défenses de Voldemort. Pour les aider dans cette délicate entreprise, Dumbledore va relancer et manipuler son ancien collègue, le Professeur Horace Slughorn, qu'il croit en possession d'informations vitales sur le jeune Voldemort. Mais un autre mal hante cette année les étudiants : le démon de l'adolescence !",
                "slug" => "harry-potter-et-le-prince-de-sang-mele"
            ],

            [
                "title" => "Harry Potter et les reliques de la mort - partie 1",
                "release" => "40506",
                "duration" => "146",
                "rating" => "-12 ans",
                "description" => "Le pouvoir de Voldemort s'étend. Celui-ci contrôle maintenant le Ministère de la Magie et Poudlard. Harry, Ron et Hermione décident de terminer le travail commencé par Dumbledore, et de retrouver les derniers Horcruxes pour vaincre le Seigneur des Ténèbres. Mais il reste bien peu d'espoir aux trois sorciers, qui doivent réussir à tout prix.",
                "slug" => "harry-potter-et-les-reliques-de-la-mort-partie-1"
            ],
            [
                "title" => "Harry Potter et les reliques de la mort - partie 2",
                "release" => "40737",
                "duration" => "130",
                "rating" => "-12 ans",
                "description" => "Dans la 2e Partie de cet épisode final, le combat entre les puissances du bien et du mal de l’univers des sorciers se transforme en guerre sans merci. Les enjeux n’ont jamais été si considérables et personne n’est en sécurité. Mais c’est Harry Potter qui peut être appelé pour l’ultime sacrifice alors que se rapproche l’ultime épreuve de force avec Voldemort.",
                "slug" => "harry-potter-et-les-reliques-de-la-mort-partie-2"
            ],
            [
                "title" => "Avengers L'ère d'Ultron",
                "release" => "42146",
                "duration" => "141",
                "rating" => "Tous publics",
                "description" => "Alors que Tony Stark tente de relancer un programme de maintien de la paix jusque-là suspendu, les choses tournent mal et les super-héros Iron Man, Captain America, Thor, Hulk, Black Widow et Hawkeye vont devoir à nouveau unir leurs forces pour combattre le plus puissant de leurs adversaires : le terrible Ultron, un être technologique terrifiant qui s’est juré d’éradiquer l’espèce humaine. Afin d’empêcher celui-ci d’accomplir ses sombres desseins, des alliances inattendues se scellent, les entraînant dans une incroyable aventure et une haletante course contre le temps…",
                "slug" => "avengers-lere-dultron"
            ],
            [
                "title" => "Avengers: Infinity War",
                "release" => "43215",
                "duration" => "156",
                "rating" => "Tous publics",
                "description" => "Les Avengers et leurs alliés devront être prêts à tout sacrifier pour neutraliser le redoutable Thanos avant que son attaque éclair ne conduise à la destruction complète de l’univers.",
                "slug" => "avengers-infinity-war"
            ],
            [
                "title" => "Avengers: Endgame",
                "release" => "45406",
                "duration" => "181",
                "rating" => "Tous publics",
                "description" => "Thanos ayant anéanti la moitié de l’univers, les Avengers restants resserrent les rangs dans ce vingt-deuxième film des Studios Marvel, grande conclusion d’un des chapitres de l’Univers Cinématographique Marvel.",
                "slug" => "avengers-endgame"
            ],
            [
                "title" => "Spider-Man",
                "release" => "41072",
                "duration" => "121",
                "rating" => "Tous publics",
                "description" => "Orphelin, Peter Parker est élevé par sa tante May et son oncle Ben dans le quartier Queens de New York. Tout en poursuivant ses études à l'université, il trouve un emploi de photographe au journal Daily Bugle. Il partage son appartement avec Harry Osborn, son meilleur ami, et rêve de séduire la belle Mary Jane. Cependant, après avoir été mordu par une araignée génétiquement modifiée, Peter voit son agilité et sa force s'accroître et se découvre des pouvoirs surnaturels. Devenu Spider-Man, il décide d'utiliser ses nouvelles capacités au service du bien. Au même moment, le père de Harry, le richissime industriel Norman Osborn, est victime d'un accident chimique qui a démesurément augmenté ses facultés intellectuelles et sa force, mais l'a rendu fou. Il est devenu le Bouffon Vert, une créature démoniaque qui menace la ville. Entre lui et Spider-Man, une lutte sans merci s'engage.",
                "slug" => "spider-man"
            ],



            [
                "title" => "Spider-Man 2",
                "release" => "38182",
                "duration" => "127",
                "rating" => "Tous publics",
                "description" => "Ecartelé entre son identité secrète de Spider-Man et sa vie d'étudiant, Peter Parker n'a pas réussi à garder celle qu'il aime, Mary Jane, qui est aujourd'hui comédienne et fréquente quelqu'un d'autre. Guidé par son seul sens du devoir, Peter vit désormais chacun de ses pouvoirs à la fois comme un don et comme une malédiction. Par ailleurs, l'amitié entre Peter et Harry Osborn est elle aussi menacée. Harry rêve plus que jamais de se venger de Spider-Man, qu'il juge responsable de la mort de son père. La vie de Peter se complique encore lorsque surgit un nouvel ennemi : le redoutable Dr Otto Octavius. Cerné par les choix et les épreuves qui engagent aussi bien sa vie intime que l'avenir du monde, Peter doit affronter son destin et faire appel à tous ses pouvoirs afin de se battre sur tous les fronts...",
                "slug" => "spider-man-2"
            ],
            [
                "title" => "Spider-Man 3",
                "release" => "39203",
                "duration" => "139",
                "rating" => "Tous publics",
                "description" => "",
                "slug" => "spider-man-3"
            ],
            [
                "title" => "The Amazing Spider-Man",
                "release" => "41094",
                "duration" => "137",
                "rating" => "Tous publics",
                "description" => "Abandonné par ses parents lorsqu’il était enfant, Peter Parker a été élevé par son oncle Ben et sa tante May. Il est aujourd’hui au lycée, mais il a du mal à s’intégrer. Comme la plupart des adolescents de son âge, Peter essaie de comprendre qui il est et d’accepter son parcours. Amoureux pour la première fois, lui et Gwen Stacy découvrent les sentiments, l’engagement et les secrets. En retrouvant une mystérieuse mallette ayant appartenu à son père, Peter entame une quête pour élucider la disparition de ses parents, ce qui le conduit rapidement à Oscorp et au laboratoire du docteur Curt Connors, l’ancien associé de son père. Spider-Man va bientôt se retrouver face au Lézard, l’alter ego de Connors. En décidant d’utiliser ses pouvoirs, il va choisir son destin…",
                "slug" => "the-amazing-spider-man"
            ],
            [
                "title" => "The Amazing Spider-Man : le destin d'un Héros",
                "release" => "41759",
                "duration" => "144",
                "rating" => "Tous publics",
                "description" => "Ce n’est un secret pour personne que le combat le plus rude de Spider-Man est celui qu’il mène contre lui-même en tentant de concilier la vie quotidienne de Peter Parker et les lourdes responsabilités de Spider-Man. Mais Peter Parker va se rendre compte qu’il fait face à un conflit de bien plus grande ampleur. Être Spider-Man, quoi de plus grisant ? Peter Parker trouve son bonheur entre sa vie de héros, bondissant d’un gratte-ciel à l’autre, et les doux moments passés aux côté de Gwen. Mais être Spider-Man a un prix : il est le seul à pouvoir protéger ses concitoyens new-yorkais des abominables méchants qui menacent la ville. Face à Electro, Peter devra affronter un ennemi nettement plus puissant que lui. Au retour de son vieil ami Harry Osborn, il se rend compte que tous ses ennemis ont un point commun : OsCorp.",
                "slug" => "the-amazing-spider-man-le-destin-dun-heros"
            ],
            [
                "title" => "Spider-Man: Homecoming",
                "release" => "42928",
                "duration" => "133",
                "rating" => "Tous publics",
                "description" => "Après ses spectaculaires débuts dans Captain America : Civil War, le jeune Peter Parker découvre peu à peu sa nouvelle identité, celle de Spider-Man, le super-héros lanceur de toile. Galvanisé par son expérience avec les Avengers, Peter rentre chez lui auprès de sa tante May, sous l’œil attentif de son nouveau mentor, Tony Stark. Il s’efforce de reprendre sa vie d’avant, mais au fond de lui, Peter rêve de se prouver qu’il est plus que le sympathique super héros du quartier. L’apparition d’un nouvel ennemi, le Vautour, va mettre en danger tout ce qui compte pour lui...",
                "slug" => "spider-man-homecoming"
            ],
            [
                "title" => "Spider-Man: Far From Home",
                "release" => "43649",
                "duration" => "130",
                "rating" => "Tous publics",
                "description" => "L'araignée sympa du quartier décide de rejoindre ses meilleurs amis Ned, MJ, et le reste de la bande pour des vacances en Europe. Cependant, le projet de Peter de laisser son costume de super-héros derrière lui pendant quelques semaines est rapidement compromis quand il accepte à contrecoeur d'aider Nick Fury à découvrir le mystère de plusieurs attaques de créatures, qui ravagent le continent !",
                "slug" => "spider-man-far-from-home"
            ],
            [
                "title" => "Spider-Man: No Way Home",
                "release" => "44545",
                "duration" => "148",
                "rating" => "Tous publics",
                "description" => "Pour la première fois dans son histoire cinématographique, Spider-Man, le héros sympa du quartier est démasqué et ne peut désormais plus séparer sa vie normale de ses lourdes responsabilités de super-héros. Quand il demande de l'aide à Doctor Strange, les enjeux deviennent encore plus dangereux, le forçant à découvrir ce qu'être Spider-Man signifie véritablement.",
                "slug" => "spider-man-no-way-home"
            ],
            [
                "title" => "Spider-Man : Across The Spider-Verse",
                "release" => "45049",
                "duration" => "141",
                "rating" => "Tous publics",
                "description" => "Après avoir retrouvé Gwen Stacy, Spider-Man, le sympathique héros originaire de Brooklyn, est catapulté à travers le Multivers, où il rencontre une équipe de Spider-Héros chargée d'en protéger l'existence. Mais lorsque les héros s'opposent sur la façon de gérer une nouvelle menace, Miles se retrouve confronté à eux et doit redéfinir ce que signifie être un héros afin de sauver les personnes qu'il aime le plus.",
                "slug" => "spider-man-across-the-spider-verse"
            ],
            [
                "title" => "Spider-Man : New Generation",
                "release" => "43446",
                "duration" => "113",
                "rating" => "Tous publics",
                "description" => "Spider-Man : New Generation suit les aventures de Miles Morales, un adolescent afro-américain et portoricain qui vit à Brooklyn et s’efforce de s’intégrer dans son nouveau collège à Manhattan. Mais la vie de Miles se complique quand il se fait mordre par une araignée radioactive et se découvre des super-pouvoirs : il est désormais capable d’empoisonner ses adversaires, de se camoufler, de coller littéralement aux murs et aux plafonds ; son ouïe est démultipliée... Dans le même temps, le plus redoutable cerveau criminel de la ville, le Caïd, a mis au point un accélérateur de particules nucléaires capable d’ouvrir un portail sur d’autres univers. Son invention va provoquer l’arrivée de plusieurs autres versions de Spider-Man dans le monde de Miles, dont un Peter Parker plus âgé, Spider-Gwen, Spider-Man Noir, Spider-Cochon et Peni Parker, venue d’un dessin animé japonais.",
                "slug" => "spider-man-new-generation" ],

            [
                "title" => "Vaiana la légende du bout du monde",
                "release" => "42704",
                "duration" => "100",
                "rating" => "Tous publics",
                "description" => "Il y a 3 000 ans, les plus grands marins du monde voyagèrent dans le vaste océan Pacifique...",
                "slug" => "vaiana-la-legende-du-bout-du-monde"
            ],
            [
                "title" => "Vaiana 2",
                "release" => "45623",
                "duration" => "90",
                "rating" => "Tous publics",
                "description" => "Après avoir reçu une invitation inattendue de ses ancêtres...",
                "slug" => "vaiana-2"
            ],
            [
                "title" => "Mais où est donc passée la septième compagnie",
                "release" => "27011",
                "duration" => "80",
                "rating" => "Tous publics",
                "description" => "Pendant la débâcle française de 1940, la 7ème compagnie se réfugie dans les bois...",
                "slug" => "mais-ou-est-donc-passee-la-septieme-compagnie"
            ],
            [
                "title" => "On a retrouvé la 7ème compagnie",
                "release" => "27738",
                "duration" => "90",
                "rating" => "Tous publics",
                "description" => "Tentant de rejoindre le sud de la France, les rescapés de la 7ème compagnie...",
                "slug" => "on-a-retrouve-la-septieme-compagnie"
            ],
            [
                "title" => "La Septième compagnie au clair de lune",
                "release" => "28466",
                "duration" => "90",
                "rating" => "",
                "description" => "Sous l'Occupation, le héros de la Septième compagnie Chaudard...",
                "slug" => "la-septieme-compagnie-au-clair-de-lune"
            ],
            [
                "title" => "Deadpool & Wolverine",
                "release" => "45497",
                "duration" => "127",
                "rating" => "-12 ans",
                "description" => "Après avoir échoué à rejoindre l’équipe des Avengers, Wade Wilson...",
                "slug" => "deadpool-wolverine"
            ],
            [
                "title" => "Deadpool",
                "release" => "42410",
                "duration" => "108",
                "rating" => "-12 ans",
                "description" => "Deadpool, est l'anti-héros le plus atypique de l'univers Marvel...",
                "slug" => "deadpool"
            ],
            [
                "title" => "Deadpool 2",
                "release" => "43230",
                "duration" => "120",
                "rating" => "-12 ans",
                "description" => "L’insolent mercenaire de Marvel remet le masque...",
                "slug" => "deadpool-2"
            ]
        ];



        // Insérer les films dans la table movie
        $this->db->table('movie')->insertBatch($data);
    }
}
