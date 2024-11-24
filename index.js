const suggestions = [
  'Kurti',
  'Sari',
  'Lehenga',
  'Anarkali',
  'Salwar Kameez',
  'Choli',
];
const searchBar = document.getElementById('search-bar');
const suggestionsList = document.getElementById('suggestions-list');

searchBar.addEventListener('input', function () {
  const input = searchBar.value.toLowerCase();
  suggestionsList.innerHTML = '';
  if (input) {
    const filteredSuggestions = suggestions.filter(item => item.toLowerCase().includes(input));
    filteredSuggestions.forEach(suggestion => {
      const li = document.createElement('li');
      li.textContent = suggestion;
      li.addEventListener('click', function () {
        searchBar.value = suggestion;
        suggestionsList.innerHTML = '';
      });
      suggestionsList.appendChild(li);
    });
  }
});
