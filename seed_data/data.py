from typing import List, Dict, Tuple, Union

ProductType = List[str]
ProductInfoType = List[Union[str, Tuple[str, str, str, str]]]
CategoryType = Dict[str, ProductInfoType]
ProductsType = List[Dict[str, CategoryType]]

products: ProductsType = [
    {
        "Materiały budowlane": {
            "Cement portlandzki": ["Cement portlandzki", "kg", ("Lafarge", "Holcim", "Cemex", "HeidelbergCement")],
            "Cement szybkowiążący": ["Cement szybkowiążący", "kg", ("Lafarge", "Holcim", "Quikrete", "Mapei")],
            "Wapno hydratyzowane": ["Wapno hydratyzowane", "kg", ("Kreisel", "Schenker", "Dolomitex", "Nordkalk")],
            "Gips budowlany": ["Gips budowlany", "kg", ("Knauf", "Rigips", "Siniat", "Norgips")],
            "Piasek": ["Piasek", "kg", ("Budmax", "SilicaCo", "Piaskopol", "SandKing")],
            "Żwir": ["Żwir", "kg", ("Granitex", "Żwirex", "StoneMax", "RockSolid")],
            "Kruszywa drobne": ["Kruszywo drobne", "kg", ("Dolomix", "MicroGravel", "FineStone", "KruszywaPol")],
            "Kruszywa łamane": ["Kruszywo łamane", "kg", ("Polgravel", "CrushStone", "StoneBreak", "HardRock")],
            "Gazobeton": ["Gazobeton", "kg", ("Ytong", "H+H", "Solbet", "Betongaz")],
            "Cegły ceramiczne": ["Cegły ceramiczne", "szt.", ("Wienerberger", "Porotherm", "Roben", "Lode")],
            "Cegły klinkierowe": ["Cegły klinkierowe", "szt.", ("CRH", "Roben", "ABC Klinker", "Feldhaus")],
            "Bloczki betonowe": ["Bloczki betonowe", "szt.", ("Prefabet", "Betonex", "ConcretePro", "BlocSystem")],
            "Płyty gipsowo-kartonowe": ["Płyty gipsowo-kartonowe", "szt.", ("Knauf", "Rigips", "Siniat", "Norgips")],
            "Płyty OSB": ["Płyty OSB", "szt.", ("Kronospan", "Egger", "Swiss Krono", "Medite")],
            "Płyty MDF": ["Płyty MDF", "szt.", ("Kronospan", "Egger", "Swiss Krono", "Finsa")],
            "Płyty cementowe": ["Płyty cementowe", "szt.", ("Cembrit", "James Hardie", "Cedral", "Equitone")],
        }
    },
    {
        "Izolacje":
            {
                "Wełna mineralna": ["Wełna mineralna", "cm", ("Rockwool", "Isover", "Ursa", "Paroc")],
                "Styropian": ["Styropian", "cm", ("Austrotherm", "Termo Organika", "Swisspor", "Styris")],
                "Pianka poliuretanowa": ["Pianka poliuretanowa", "cm", ("Tytan", "Soudal", "Den Braven", "Illbruck")],
                "Folie izolacyjne": ["Folia izolacyjna", "cm", ("Dachowa", "Tyvek", "Parotec", "Delta")],
                "Panele akustyczne": ["Panele akustyczne", "szt.", ("Ecophon", "Knauf", "Rockfon", "Owa")],
                "Maty dźwiękochłonne": ["Mata dźwiękochłonna", "cm", ("Rockwool", "Isover", "Paroc", "Armaflex")],
                "Pianki akustyczne": ["Pianka akustyczna", "cm", ("Piramidex", "Silentium", "SoundPro", "NoNoise")],
                "Pap bitumiczne": ["Papa bitumiczna", "cm", ("Matizol", "Bauder", "Icopal", "Technonicol")],
                "Membrany dachowe": ["Membrana dachowa", "szt.", ("Dachowa", "Delta", "Corotop", "Juta")],
                "Folie fundamentowe": ["Folia fundamentowa", "cm", ("Plastfoil", "Visqueen", "Delta-MS", "Gutta")],
            }
    },
    {
        "Narzędzia":
            {
                "Młotki": ["Młotek", "sztuka", ("Stanley", "Bosch", "DeWalt", "Makita")],
                "Śrubokręty": ["Śrubokręt", "sztuka", ("Wera", "Wiha", "Bosch", "Stanley")],
                "Klucze": ["Klucz", "sztuka", ("Yato", "Stanley", "Facom", "Gedore")],
                "Poziomice": ["Poziomica", "sztuka", ("Stabila", "Stanley", "Bosch", "Kapro")],
                "Wiertarki": ["Wiertarka", "sztuka", ("Bosch", "Makita", "DeWalt", "Metabo")],
                "Szlifierki": ["Szlifierka", "sztuka", ("Bosch", "Makita", "DeWalt", "Metabo")],
                "Wkrętarki": ["Wkrętarka", "sztuka", ("Bosch", "Makita", "DeWalt", "Ryobi")],
                "Miarki": ["Miarka", "sztuka", ("Stanley", "Bosch", "Kapro", "DeWalt")],
                "Dalmierze": ["Dalmierz", "sztuka", ("Leica", "Bosch", "Stanley", "Makita")],
                "Suwmiarki": ["Suwmiarka", "sztuka", ("Mitutoyo", "Fowler", "Starrett", "Mahr")],
                "Piły ręczne": ["Piła ręczna", "sztuka", ("Bahco", "Stanley", "Irwin", "Sandvik")],
                "Młoty udarowe": ["Młot udarowy", "sztuka", ("Bosch", "Makita", "DeWalt", "Hilti")],
                "Lasery krzyżowe": ["Laser krzyżowy", "sztuka", ("Bosch", "DeWalt", "Leica", "Stanley")],
                "Piły mechaniczne": ["Piła mechaniczna", "sztuka", ("Stihl", "Husqvarna", "Makita", "Bosch")],
            }
    },
    {
        "Instalacje":
            {
                "Kable": ["Kabel", "m", ("NKT", "Draka", "Prysmian", "Tele-Fonika")],
                "Przewody": ["Przewód", "m", ("NKT", "Draka", "Prysmian", "Tele-Fonika")],
                "Rury": ["Rura", "m", ("Wavin", "Pipelife", "Uponor", "Rehau")],
                "Gniazdka": ["Gniazdko", "szt.", ("Legrand", "Schneider Electric", "ABB", "Ospel")],
                "Włączniki": ["Włącznik", "szt.", ("Legrand", "Schneider Electric", "ABB", "Ospel")],
                "Zawory": ["Zawór", "szt.", ("Honeywell", "Danfoss", "Herz", "Oventrop")],
                "Kształtki": ["Kształtnik", "szt.", ("Wavin", "Pipelife", "Uponor", "Rehau")],
                "Złączki": ["Złączka", "szt.", ("Wavin", "Pipelife", "Uponor", "Rehau")],
                "Pompy": ["Pompa", "sztuka", ("Grundfos", "Wilo", "DAB", "Lowara")],
                "Kotły": ["Kocioł", "sztuka", ("Viessmann", "Vaillant", "Junkers", "Buderus")],
                "Grzejniki": ["Grzejnik", "sztuka", ("Purmo", "Kermi", "Stelrad", "Radson")],
                "Klimatyzatory": ["Klimatyzator", "sztuka", ("Daikin", "Mitsubishi Electric", "LG", "Samsung")],
                "Rekuperatory": ["Rekuperator", "sztuka", ("Vents", "Dospel", "Zehnder", "Systemair")],
                "Skrzynki bezpiecznikowe": ["Skrzynka bezpiecznikowa", "sztuka", ("Hager", "Schneider Electric", "Legrand", "Eaton")],
            }
    },
    {
        "Artykuły sanitarne":
            {
                "Wanny": ["Wanna", "sztuka", ("Roca", "Koło", "Cersanit", "Villeroy & Boch")],
                "Umywalki": ["Umywalka", "sztuka", ("Roca", "Koło", "Cersanit", "Villeroy & Boch")],
                "Toalety": ["Toaleta", "sztuka", ("Roca", "Koło", "Cersanit", "Villeroy & Boch")],
                "Zlewozmywaki": ["Zlewozmywak", "sztuka", ("Franke", "Teka", "Blanco", "Alveus")],
                "Okapy": ["Okap", "sztuka", ("Faber", "Elica", "Bosch", "Siemens")],
                "Baterie kuchenne": ["Bateria kuchenna", "sztuka", ("Grohe", "Hansgrohe", "Franke", "Blanco")],
                "Kabiny prysznicowe": ["Kabina prysznicowa", "sztuka", ("Roca", "Koło", "Cersanit", "Sanplast")],
                "Baterie łazienkowe": ["Bateria łazienkowa", "sztuka", ("Grohe", "Hansgrohe", "Kludi", "Roca")],
                "Płyty grzewcze": ["Płyta grzewcza", "sztuka", ("Bosch", "Siemens", "Electrolux", "Samsung")],
            }
    },
    {
        "Wykończenia wnętrz":
            {
                "Deski": ["Deski", "m", ("Barlinek", "Kährs", "Tarkett", "Panmar")],
                "Tapety": ["Tapeta", "m", ("Rasch", "Marburg", "AS Création", "Arte")],
                "Farby": ["Farba", "l", ("Dulux", "Tikkurila", "Beckers", "Śnieżka")],
                "Tynki dekoracyjne": ["Tynk dekoracyjny", "kg", ("Caparol", "Sto", "Knauf", "Ceresit")],
                "Rolety": ["Roleta", "szt.", ("Fakro", "Velux", "Somfy", "Anwis")],
                "Wykładziny": ["Wykładzina", "szt.", ("Balta", "Desso", "Tarkett", "Associated Weavers")],
                "Okna": ["Okno", "szt.", ("Drutex", "Veka", "Oknoplast", "Rehau")],
                "Boazerie": ["Boazeria", "szt.", ("Klimex", "Baltic Wood", "Barlinek", "Kährs")],
                "Parapety": ["Parapet", "szt.", ("Parapety24", "Parapetex", "Deceuninck", "WnD")],
                "Panele podłogowe": ["Panele podłogowe", "szt.", ("Quick-Step", "Kronospan", "Classen", "Pergo")],
                "Płytki ceramiczne": ["Płytki ceramiczne", "szt.", ("Paradyż", "Opoczno", "Ceramika Tubądzin", "Cersanit")],
                "Drzwi wewnętrzne": ["Drzwi wewnętrzne", "sztuka", ("Porta", "DRE", "Pol-Skone", "Invado")],
                "Drzwi zewnętrzne": ["Drzwi zewnętrzne", "sztuka", ("Gerda", "Dierre", "Wiśniowski", "KMT")],
            }
    },
    {
        "Ogród i zewnętrze":
            {
                "Ziemia": ["Ziemia", "kg", ("Compo", "Substral", "HUMO", "Biovita")],
                "Nawozy": ["Nawóz", "kg", ("Compo", "Substral", "Florovit", "Agrecol")],
                "Środki ochrony roślin": ["Środki ochrony roślin", "l", ("Bayer", "Substral", "Agrecol", "Scotts")],
                "Nasiona": ["Nasiona", "szt.", ("Toraf", "Legutko", "W.Legutko", "Polan")],
                "Sekatory": ["Sekator", "szt.", ("Fiskars", "Felco", "Wolf-Garten", "Gardena")],
                "Grabie": ["Grabie", "szt.", ("Fiskars", "Wolf-Garten", "Gardena", "Silverline")],
                "Łopaty": ["Łopata", "szt.", ("Fiskars", "Stanley", "Silverline", "Spear & Jackson")],
                "Pergole": ["Pergola", "szt.", ("Pergolex", "SunGarden", "AluHouse", "GardenArt")],
                "Tarasy": ["Taras", "sztuka", ("Decks", "ProDeck", "Twinson", "Thermory")],
                "Altany": ["Altana", "sztuka", ("Ogrodosfera", "Dom-Art", "AltanyMarzeń", "Altanex")],
                "Kosiarki": ["Kosiarka", "sztuka", ("Honda", "Stihl", "Husqvarna", "Gardena")],
                "Grille": ["Grill", "sztuka", ("Weber", "Landmann", "Broil King", "Campingaz")],
            }
    },
    {
        "Oświetlenie":
            {
                "Oświetlenie LED": ["Oświetlenie LED", "m", ("Philips", "Osram", "LEDVANCE", "V-TAC")],
                "Kinkiety": ["Kinkiet", "szt.", ("Philips", "Eglo", "Kanlux", "Nowodvorski")],
                "Żyrandole": ["Żyrandol", "szt.", ("Philips", "Eglo", "Kanlux", "Nowodvorski")],
                "Reflektory": ["Reflektor", "szt.", ("Philips", "Osram", "Steinel", "Kanlux")],
                "Latarnie": ["Latarnia", "szt.", ("Philips", "Eglo", "Kanlux", "Nowodvorski")],
                "Lampy sufitowe": ["Lampa sufitowa", "szt.", ("Philips", "Eglo", "Kanlux", "Nowodvorski")],
                "Lampy ogrodowe": ["Lampa ogrodowa", "szt.", ("Philips", "Eglo", "Kanlux", "Steinel")],
                "Oświetlenie solarne": ["Oświetlenie solarne", "szt.", ("Philips", "Eglo", "Kanlux", "V-TAC")],
            }
    },
    {
        "Zabezpieczenia":
            {
                "Alarmy": ["Alarm", "szt.", ("Satel", "Jablotron", "DSC", "Yale")],
                "Kamery": ["Kamera", "szt.", ("Hikvision", "Dahua", "Axis", "Bosch")],
                "Wideodomofony": ["Wideodomofon", "szt.", ("Kenwei", "Vidos", "Commax", "Hikvision")],
                "Zamki": ["Zamek", "szt.", ("Gerda", "Yale", "Abus", "Lob")],
                "Kraty": ["Krata", "szt.", ("Pol-Krat", "Kratbet", "KratkiSwarzędz", "Stalmet")],
                "Sejfy": ["Sejf", "sztuka", ("Yale", "Metalkas", "Hartmann Tresore", "SentrySafe")],
                "Czujniki ruchu": ["Czujnik ruchu", "szt.", ("Bosch", "Steinel", "Jablotron", "Optex")],
                "Wkładki do zamków": ["Wkładka do zamka", "szt.", ("Gerda", "Yale", "Abus", "KESO")],
            }
    },
    {
        "Chemia budowlana":
            {
                "Kleje do płytek": ["Klej do płytek", "l", ("Ceresit", "Sopro", "Mapei", "Weber")],
                "Lakiery do drewna": ["Lakier do drewna", "l", ("Sadolin", "Vidaron", "Bondex", "Osmo")],
                "Fugi": ["Fuga", "l", ("Ceresit", "Sopro", "Mapei", "Weber")],
                "Silikony": ["Silikon", "l", ("Soudal", "Tytan", "Den Braven", "Ceresit")],
                "Impregnaty": ["Impregnat", "l", ("Sadolin", "Vidaron", "Bondex", "Altax")],
                "Farby emulsyjne": ["Farba emulsyjna", "l", ("Dulux", "Tikkurila", "Beckers", "Śnieżka")],
                "Farby olejne": ["Farba olejna", "l", ("Dekoral", "Nobiles", "Sigma", "Hammerite")],
                "Zaprawy murarskie": ["Zaprawa murarskia", "kg", ("Ceresit", "Atlas", "Baumit", "Quick-Mix")],
            }
    },
    {
        "Odzież robocza":
            {
                "Kombinezony": ["Kombinezon", "szt.", ("3M", "DuPont", "Uvex", "Delta Plus")],
                "Kurtki": ["Kurtka", "szt.", ("Snickers", "Engelbert Strauss", "Helly Hansen", "Delta Plus")],
                "Kalosze": ["Kalosze", "szt.", ("Demar", "Lemigo", "Dunlop", "Bekina")],
                "Kaski": ["Kask", "szt.", ("3M", "Uvex", "Delta Plus", "Portwest")],
                "Rękawice": ["Rękawice", "szt.", ("Ansell", "Mapa", "Showa", "Uvex")],
                "Nauszniki": ["Nauszniki", "szt.", ("3M", "Peltor", "Uvex", "Howard Leight")],
                "Spodnie robocze": ["Spodnie robocze", "szt.", ("Snickers", "Engelbert Strauss", "Helly Hansen", "Delta Plus")],
                "Kamizelki odblaskowe": ["Kamizelka odblaskowa", "szt.", ("3M", "Delta Plus", "Uvex", "Portwest")],
                "Sandały robocze": ["Sandały robocze", "szt.", ("Bata Industrials", "Puma Safety", "Cofra", "U-Power")],
                "Okulary ochronne": ["Okulary ochronne", "szt.", ("Uvex", "3M", "Bolle", "Honeywell")],
                "Buty z podnoskami": ["Buty z podnoskami", "szt.", ("Bata Industrials", "Puma Safety", "Cofra", "U-Power")],
            }
    },
    {
        "Transport i przechowywanie":
            {
                "Wózki ręczne": ["Wózek ręczny", "sztuka", ("Hörmann", "Penny", "Protaurus", "Fort")],
                "Wózki paletowe": ["Wózek paletowy", "sztuka", ("Still", "Jungheinrich", "Linde", "BT")],
                "Wózki taczkowe": ["Wózek taczkowy", "sztuka", ("Hörmann", "Penny", "Protaurus", "Fort")],
                "Regały magazynowe": ["Regał magazynowy", "sztuka", ("Metalkas", "Sevillana", "Penny", "Keter")],
                "Skrzynie narzędziowe": ["Skrzynia narzędziowa", "szt.", ("Stanley", "DeWalt", "Bosch", "Keter")],
                "Pojemniki na odpady": ["Pojemnik na odpady", "szt.", ("ESE", "SULO", "PWS", "Otto")],
            }
    },
    {
        "Energetyka odnawialna":
            {
                "Pompy ciepła powietrzne": ["Pompa ciepła powietrzna", "sztuka", ("Daikin", "Panasonic", "Mitsubishi Electric", "Samsung")],
                "Panele fotowoltaiczne": ["Panele fotowoltaiczne", "szt.", ("LG", "Trina Solar", "JinkoSolar", "Canadian Solar")],
                "Pompy ciepła gruntowe": ["Pompa ciepła gruntowa", "szt.", ("Viessmann", "Bosch", "Nibe", "Vaillant")],
                "Małe turbiny wiatrowe": ["Mała turbina wiatrowa", "szt.", ("WindEnergy", "Windspire", "Helix Wind", "Skystream")],
                "Panele termiczne": ["Panele termiczne", "szt.", ("Viessmann", "Bosch", "Junkers", "Vaillant")],
                "Akcesoria do turbin wiatrowych": ["Akcesoria do turbin wiatrowych", "szt.", ("WindEnergy", "Windspire", "Helix Wind", "Skystream")],
                "Akcesoria do pomp ciepła": ["Akcesoria do pomp ciepła", "szt.", ("Viessmann", "Bosch", "Nibe", "Vaillant")]
            }
    }
]

lorem = '''Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quam lectus, vestibulum non orci ac, viverra placerat sapien. Duis quis orci a dui aliquam venenatis. Nullam auctor semper odio vitae tincidunt. In imperdiet pulvinar consequat. Ut dapibus blandit enim, et lobortis eros pellentesque et. Nulla sem est, dictum ac velit nec, pretium porta lectus. Integer porta suscipit elementum. Proin aliquam imperdiet purus. Cras sit amet sagittis turpis.'''

if __name__ == "__main__":
    for group in products:
        for group_name, items in group.items():
            print(f"Group: {group_name}")
            for product_name, product_info in items.items():
                for prod in product_info[2]:
                    print(f"  Product: {product_info[0]} {prod}, {
                        product_info[1]}")
        break
