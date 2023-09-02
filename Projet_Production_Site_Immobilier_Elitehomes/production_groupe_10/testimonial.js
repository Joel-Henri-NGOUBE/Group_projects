//Testimonial Data
const testimonials = [
  {
    name: "Eva Sawyer",
    job: "CEO, Fashworks",
    image: "./images/profile-image-1.png",
    testimonial:
      "J'ai eu la chance de louer un superbe appartement de luxe à Paris lors de mon voyage d'affaires. L'emplacement était parfait, juste à côté des Champs-Élysées. L'appartement était spacieux, élégamment décoré et offrait une vue imprenable sur la Tour Eiffel. Les équipements étaient haut de gamme et le service était impeccable. Je me sentais vraiment comme une princesse vivant à Paris pendant mon séjour. Je recommande vivement cette expérience de luxe à tous ceux qui veulent vivre une expérience unique dans la Ville Lumière.",
  },
  {
    name: "Katey Topaz",
    job: "Developer, TechCrew",
    image: "./images/profile-image-2.png",
    testimonial:
     "Je suis venue à Paris avec ma famille pour des vacances inoubliables et nous avons décidé de louer un logement de luxe. L'appartement était tout simplement incroyable ! Il était magnifiquement meublé, avec des finitions haut de gamme et une attention aux détails exceptionnelle. Les vues sur la Seine depuis notre terrasse étaient à couper le souffle. Nous avions également accès à une piscine privée, un spa et une salle de sport. Nous nous sommes sentis comme des célébrités pendant tout notre séjour. Si vous voulez vivre le luxe à Paris, ne cherchez pas plus loin !",
  },
  {
    name: "Jae Robin",
    job: "UI Designer, Affinity Agency",
    image: "./images/profile-image-3.png",
    testimonial:
     "Mon séjour à Paris dans un logement de luxe a été tout simplement magique. L'appartement était situé dans le quartier historique du Marais, entouré de charmantes rues pavées et de boutiques de créateurs. À l'intérieur, j'ai été accueillie par un intérieur élégant, avec des meubles design et des œuvres d'art contemporaines. Le service était exceptionnel, avec un concierge disponible 24h/24 pour répondre à tous nos besoins. J'ai adoré me réveiller chaque matin dans un tel cadre luxueux et profiter de tout ce que Paris a à offrir.",
  },
  {
    name: "Nicola Blakely",
    job: "CEO,Zeal Wheels",
    image: "./images/profile-image-4.png",
    testimonial:
     "Je cherchais un hébergement de luxe pour mon voyage romantique à Paris, et j'ai été agréablement surprise par l'appartement que j'ai loué. Il était situé près de la Tour Eiffel et avait une vue imprenable sur elle depuis le balcon. L'intérieur était élégant et raffiné, avec des draps en satin et une baignoire spa dans la salle de bains. Nous nous sentions vraiment comme des VIP pendant notre séjour. La proximité des restaurants étoilés et des boutiques de luxe a ajouté une touche spéciale à notre expérience. Je suis tombée amoureuse de Paris encore plus grâce à ce séjour luxueux." ,
  },
];

//Current Slide
let i = 0;
//Total Slides
let j = testimonials.length;

let testimonialContainer = document.getElementById("testimonial-container");
let nextBtn = document.getElementById("next");
let prevBtn = document.getElementById("prev");

nextBtn.addEventListener("click", () => {
  i = (j + i + 1) % j;
  displayTestimonial();
});
prevBtn.addEventListener("click", () => {
  i = (j + i - 1) % j;
  displayTestimonial();
});

let displayTestimonial = () => {
  testimonialContainer.innerHTML = `
    <p>${testimonials[i].testimonial}</p>
    <img src=${testimonials[i].image}>
    <h3>${testimonials[i].name}</h3>
    <h6>${testimonials[i].job}</h6>
  `;
};
window.onload = displayTestimonial;
