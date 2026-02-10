const API_URL = "http://localhost:8000/index.php?route=movies";

async function loadMovies() {
    try {
        const response = await fetch(API_URL);
        const data = await response.json();

        const tbody = document.getElementById("movies-list");
        tbody.innerHTML = "";

        if (data.data) {
            data.data.forEach(movie => {
                const row = `
                    <tr>
                        <td>${movie.id}</td>
                        <td><strong>${movie.title}</strong></td>
                        <td>${movie.duration} min</td>
                        <td>${movie.release_year}</td>
                        <td>
                            <button class="btn btn-sm btn-danger">Supprimer</button>
                        </td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });
        } else {
            tbody.innerHTML = "<tr><td colspan='5'>Aucun film trouvé</td></tr>";
        }
    } catch (error) {
        console.error("Erreur:", error);
    }
}

// Form submission logic
document.getElementById("add-movie-form").addEventListener("submit", async function(e) {
    e.preventDefault();
    
    const movieData = {
        title: document.getElementById("title").value,
        duration: parseInt(document.getElementById("duration").value),
        release_year: parseInt(document.getElementById("release_year").value),
        description: document.getElementById("description").value
    };
    
    try {
        const response = await fetch(API_URL, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(movieData)
        });
        
        const result = await response.json();
        alert(result.message);
        
        // Reset form
        document.getElementById("add-movie-form").reset();
        
        // Reload movies list
        loadMovies();
    } catch (error) {
        console.error("Erreur:", error);
        alert("Erreur lors de l'ajout du film");
    }
});

// Load movies on page load
loadMovies();