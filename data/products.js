const products = [
  {
    id: "0000-0001",
    image: "images/products/dry_strawberry.gif",
    name: "Сушени ягоди",
    quantity: [250,500,1000,2000],
    priceCents: [700,1300,2500,4750],
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0000-0010",
    image: "images/products/dry_raspberry.jpg",
    name: "Сушени малини",
    quantity: [250,500,1000,2000],
    priceCents: [750,1400,2700,5000],
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0000-0011",
    image: "images/products/dry_peach.png",
    name: "Сушени праскови",
    quantity: [250,500,1000,2000],
    priceCents: [500,950,1750,3400],
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0000-0100",
    image: "images/products/dry_apricot.jpg",
    name: "Сушени кайсии",
    quantity: [250,500,1000,2000],
    priceCents: [600,1100,2000,3750],
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0000-0101",
    image: "images/products/dry_black_mulberry.jpg",
    name: "Сушени черници",
    quantity: [250,500,1000,2000],
    priceCents: [700,1300,2500,4750],
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0000-0110",
    image: "images/products/dry_white_mulberry.jpg",
    name: "Сушени бели черници",
    quantity: [250,500,1000,2000],
    priceCents: [700,1300,2500,4750],
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0000-0111",
    image: "images/products/dry_figs.jpg",
    name: "Сушени смокини",
    quantity: [250,500,1000,2000],
    priceCents: [500,950,1750,3400],
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0000-1000",
    image: "images/products/dry_cherries.jpg",
    name: "Сушени череши",
    quantity: [250,500,1000,2000],
    priceCents: [750,1400,2700,5000],
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0000-1001",
    image: "images/products/dry_red_apple.png",
    name: "Сушени чбълки",
    quantity: [250,500,1000,2000],
    priceCents: [500,950,1750,3400],
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0000-1010",
    image: "images/products/dry_pear.webp",
    name: "Сушени круши",
    quantity: [250,500,1000,2000],
    priceCents: [500,950,1750,3400],
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0000-1011",
    image: "images/products/dry_pulm.avif",
    name: "Сушени сливи",
    quantity: [250,500,1000,2000],
    priceCents: [600,1100,2100,4000],
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0000-1100",
    image: "images/products/kompot_strawberry.jpg",
    name: "Компот ягода",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0000-1101",
    image: "images/products/kompot_peach.jpg",
    name: "Компот праскова",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0000-1110",
    image: "images/products/kompot_cherry.webp",
    name: "Компот череша",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0000-1111",
    image: "images/products/strawberry_jam.jpg",
    name: "Сладко от ягоди",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0001-0000 ",
    image: "images/products/peach_jam.jpg",
    name: "Слатко от праскови",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0001-0001",
    image: "images/products/blueberry_jam.jpg",
    name: "Сладко от боровинки",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0001-0010",
    image: "images/products/apricot_jam.jpg",
    name: "Слатко от кайсии",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0001-0011",
    image: "images/products/fig_jam.jpg",
    name: "Сладко от смокини",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0001-0100",
    image: "images/products/cherry_jam.jpg",
    name: "Сладко от череши",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0001-0101",
    image: "images/products/black_mulberries_jam.jpg",
    name: "Сладко от черници",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0001-0110",
    image: "images/products/plum_jam.jpg",
    name: "Сладко от сливи",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0001-0111",
    image: "images/products/pickles.jpg",
    name: "Кисели краставички",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0001-1000",
    image: "images/products/carska_turshiq.jpg",
    name: "Царска туршия",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0001-1001",
    image: "images/products/hot_pepper.jpg",
    name: "Люти чушки",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0001-1010",
    image: "images/products/almonds.jpg",
    name: "Бадеми",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0001-1011",
    image: "images/products/walnut.jpg",
    name: "Орехи",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0001-1100",
    image: "images/products/peanut.jpg",
    name: "Фъстъци",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0001-1101",
    image: "images/products/sirene.jpg",
    name: "Саламурено сирене",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0001-1110",
    image: "images/products/kashkaval.webp",
    name: "Кашкавал",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0001-1111",
    image: "images/products/sirene_prqsno.jpg",
    name: "Прясно сирене",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0010-0000",
    image: "images/products/kiselo_mlqko.jpg",
    name: "Кисело мляко",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0010-0001",
    image: "images/products/med.jpg",
    name: "Мед",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0010-0010",
    image: "images/products/royal_jelly.webp",
    name: "Пчелно млечице",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0010-0011",
    image: "images/products/pchelen_klei.jpg",
    name: "Пчелен клей",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0010-0100",
    image: "images/products/pchelen_prashec.jpg",
    name: "Пчелен прашец",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0010-0101",
    image: "images/products/laika.jpeg",
    name: "Лайка",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0010-0110",
    image: "images/products/lipa.jpg",
    name: "Липа",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0010-0111",
    image: "images/products/mashterka.webp",
    name: "Мащерка",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0010-1000",
    image: "images/products/rigan.webp",
    name: "Риган",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0010-1001",
    image: "images/products/jylt_kantarion.webp",
    name: "Жълт кантарион",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0010-1010",
    image: "images/products/bql_ravnec.webp",
    name: "Бял равнец",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0010-1011",
    image: "images/products/fig_leaves.png",
    name: "Смокинови листа",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
  {
    id: "0010-1100",
    image: "images/products/menta.jpg",
    name: "Мента",
    rating: {
      stars: 4.5,
      count: 87
    },
    priceCents: 1090,
    keywords: [
      "socks",
      "sports",
      "apparel"
    ]
  },
]