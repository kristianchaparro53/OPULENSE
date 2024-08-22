// Banner - Cambio automático de imagen y texto
const bannerImages = ['1.png', '2.png', '3.png'];
const bannerTexts = [
    { title: 'Conduce tu futuro', subtitle: 'El mejor auto, solo para ti.' },
    { title: 'Elegancia en movimiento', subtitle: 'Vive la experiencia de conducir.' },
    { title: 'Potencia sin límites', subtitle: 'Desata el poder del motor.' }
];

let currentIndex = 0;

function updateBanner() {
    const imageContainer = document.querySelector('.image-container');
    const textContainer = document.querySelector('.text-container h1');
    const subtitleContainer = document.querySelector('.text-container p');

    imageContainer.style.backgroundImage = `url(${bannerImages[currentIndex]})`;
    textContainer.textContent = bannerTexts[currentIndex].title;
    subtitleContainer.textContent = bannerTexts[currentIndex].subtitle;

    currentIndex = (currentIndex + 1) % bannerImages.length;
}

setInterval(updateBanner, 3000);

// Cards - Cambio automático de imagen con desvanecimiento
const cardImages = {
    'card1': ['https://i.pinimg.com/564x/29/01/fe/2901fe00fdd02f9f38c4ea7183d90cf5.jpg', 'https://i.pinimg.com/originals/75/3d/49/753d495b22d0bc7d01913be942948e95.jpg', 'https://e1.pxfuel.com/desktop-wallpaper/450/173/desktop-wallpaper-dodge-challenger-dodge-demon-black.jpg'],
    'card2': ['https://www.ram.com/content/dam/cross-regional/nafta/ramtrucks/es_mx/2024/1500-trx-2024/inicio/galeria/full/ram-trx-2024-galeria-exterior-01-full.jpg', 'https://www.ram.com/content/dam/cross-regional/nafta/ramtrucks/es_mx/2024/1500-trx-2024/inicio/galeria/full/ram-trx-2024-galeria-exterior-03-full.jpg', 'https://www.ram.com/content/dam/cross-regional/nafta/ramtrucks/es_mx/2024/1500-trx-2024/inicio/galeria/full/ram-trx-2024-galeria-interior-04-full.jpg'],
    'card3': ['https://www.ford.mx/content/ford/mx/es_mx/home/performance/shelby-gt500/2021/jcr:content/par/billboard_524874001/imageComponent/image.imgs.full.high.jpg', 'https://www.ford.mx/content/ford/mx/es_mx/home/performance/shelby-gt500/2021/jcr:content/par/common_box_1826026621/generalParsys/splitter/splitter1/image/image.imgs.full.high.jpg/1618327965406.jpg', 'https://www.ford.mx/content/ford/mx/es_mx/home/performance/shelby-gt500/2021/jcr:content/par/common_box_558992212/generalParsys/splitter/splitter1/image/image.imgs.full.high.jpg/1618327960384.jpg'],
    'card4': ['https://www.ford.mx/content/dam/Ford/website-assets/latam/mx/nameplate/raptor-2018/ranger-raptor-2024/overview/gallery-trigger/overlays/ford-ranger-raptor-2024-pickup-4x4-diseno-faros-parrilla-desierto.jpg', 'https://www.ford.mx/content/dam/Ford/website-assets/latam/mx/nameplate/raptor-2018/ranger-raptor-2024/overview/gallery-trigger/overlays/ford-ranger-raptor-2024-camioneta-pickup-4x4-detalle-distintivos-logo.jpg', 'https://www.ford.mx/content/dam/Ford/website-assets/latam/mx/nameplate/raptor-2018/ranger-raptor-2024/overview/gallery-trigger/overlays/ford-ranger-raptor-2024-camioneta-pickup-4x4-asientos-detalles-naranja.jpg'],

};

function updateCardImages(cardId) {
    const cardImage = document.querySelector(`#${cardId} .card-image`);
    let index = 0;

    setInterval(() => {
        cardImage.style.opacity = 0;
        setTimeout(() => {
            cardImage.style.backgroundImage = `url(${cardImages[cardId][index]})`;
            cardImage.style.opacity = 1;
            index = (index + 1) % cardImages[cardId].length;
        }, 1000);
    }, 3000);
}

updateCardImages('card1');
updateCardImages('card2');
updateCardImages('card3');
updateCardImages('card4');
// Repetir para cada card
