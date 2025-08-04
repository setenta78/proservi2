// JavaScript Document

function getRandomInt(min, max) {
  return Math.floor(Math.random() * (max - min)) + min;
}

document.addEventListener("DOMContentLoaded", () => {
  const ramdom = getRandomInt(1, 152);
  fetchData(ramdom);
});

const fetchData = async (id) => {
  try {
    console.log(id);

    const res = await fetch(`https://pokeapi.co/api/v2/pokemon/${id}`);
    const data = await res.json();

    console.log(data);

    const pokemon = {
      img: `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/${data.id}.png`,
      imgJuego: data.sprites.front_default,
      imgCvg: data.sprites.other.dream_world.front_default,
      nombre: data.name,
      tipo: data.types,
      altura: data.height,
      peso: data.stats[1].base_stat,
      movimiento: data.moves,
    };

    pintarCard(pokemon);
  } catch (error) {
    console.log(error);
  }
};

const pintarCard = (pokemon) => {
  const flex = document.querySelector(".flex");
  const template = document.getElementById("card").content;
  const clone = template.cloneNode(true);
  const fragment = document.createDocumentFragment();

  clone.querySelector(".card-body-img").setAttribute("src", pokemon.imgCvg);
  // clone.querySelector('.card-body-img').setAttribute('src', pokemon.imgJuego)
  clone.querySelector(
    ".card-body-title"
  ).innerHTML = `${pokemon.nombre} <span>${pokemon.hp}hp</span>`;
  clone.querySelector(".card-body-text").textContent =
    pokemon.tipo + " exp";
  clone.querySelectorAll(".card-footer-social h3")[0].textContent =
    pokemon.altura + "cm";
  clone.querySelectorAll(".card-footer-social h3")[1].textContent =
    pokemon.peso + "K";
  clone.querySelectorAll(".card-footer-social h3")[2].textContent =
    pokemon.movimiento + "K";

  fragment.appendChild(clone);
  flex.appendChild(fragment);
};