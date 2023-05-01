const search = document.querySelector('.input-group input'),
    table_rows = document.querySelectorAll('tbody tr'),
    table_headings = document.querySelectorAll('thead th');

// 1. Searching for specific data of HTML table
search.addEventListener('input', searchTable);

function searchTable() {
    table_rows.forEach((row, i) => {
        let table_data = row.textContent.toLowerCase(),
            search_data = search.value.toLowerCase();

        row.classList.toggle('hide', table_data.indexOf(search_data) < 0);
        row.style.setProperty('--delay', i / 25 + 's');
    })

    document.querySelectorAll('tbody tr:not(.hide)').forEach((visible_row, i) => {
        visible_row.style.backgroundColor = (i % 2 == 0) ? 'transparent' : '#0000000b';
    });
}

// 2. Sorting | Ordering data of HTML table

table_headings.forEach((head, i) => {
    let sort_asc = true;
    head.onclick = () => {
        table_headings.forEach(head => head.classList.remove('active'));
        head.classList.add('active');

        document.querySelectorAll('td').forEach(td => td.classList.remove('active'));
        table_rows.forEach(row => {
            row.querySelectorAll('td')[i].classList.add('active');
        })

        head.classList.toggle('asc', sort_asc);
        sort_asc = head.classList.contains('asc') ? false : true;

        sortTable(i, sort_asc);
    }
})


function sortTable(column, sort_asc) {
    [...table_rows].sort((a, b) => {
        let first_row = a.querySelectorAll('td')[column].textContent.toLowerCase(),
            second_row = b.querySelectorAll('td')[column].textContent.toLowerCase();

        return sort_asc ? (first_row < second_row ? 1 : -1) : (first_row < second_row ? -1 : 1);
    })
        .map(sorted_row => document.querySelector('tbody').appendChild(sorted_row));
}

// // 3. Compare percentage of model with advice
// // Get all the <td> elements that contain the accuracy percentage value:
// let accuracyTds = document.querySelectorAll("tbody td:nth-child(5)");
// console.log("test");
// accuracyTds.forEach(td => {
// 	// Akurasi value in td
// 	// let tdAkurasi = document.querySelector('td:contains("{{ $akurasi }}%")');
// 	// let tdRecall = document.querySelector('td:contains("{{ $recall }}%")');
// 	// let tdPrecision = document.querySelector('td:contains("{{ $precision }}%")');
// 	// let tdF1 = document.querySelector('td:contains("{{ $f1Score }}%")');

// 	// Parse Percentage
// 	let akurasiPercentage = parseFloat(td.textContent);
// 	console.log("enter looping");
// 	console.log(akurasiPercentage);
// 	let recallPercentage = parseFloat(td.textContent);
// 	let precisionPercentage = parseFloat(td.textContent);
// 	let f1Percentage = parseFloat(td.textContent);

// 	// Determine the recommendation based on the recall percentage:
// 	let recommendation;
// 	if (akurasiPercentage >= 60) {
// 	recommendation = "Strongly Recommended";
// 	} else if (akurasiPercentage >= 50 && akurasiPercentage < 60) {
// 	recommendation = "Recommended";
// 	} else {
// 	recommendation = "Better Keep Your Coins";
// 	}
// 	if (recallPercentage >= 60) {
// 	recommendation = "Strongly Recommended";
// 	} else if (recallPercentage >= 50 && recallPercentage < 60) {
// 	recommendation = "Recommended";
// 	} else {
// 	recommendation = "Better Keep Your Coins";
// 	}
// 	if (precisionPercentage >= 60) {
// 	recommendation = "Strongly Recommended";
// 	} else if (precisionPercentage >= 50 && precisionPercentage < 60) {
// 	recommendation = "Recommended";
// 	} else {
// 	recommendation = "Better Keep Your Coins";
// 	}
// 	if (f1Percentage >= 60) {
// 	recommendation = "Strongly Recommended";
// 	} else if (f1Percentage >= 50 && f1Percentage < 60) {
// 	recommendation = "Recommended";
// 	} else {
// 	recommendation = "Better Keep Your Coins";
// 	}

// 	// Get the <p> element with class "status" from the table:
// 	let recommendationEl = document.querySelector(".recommended");
// 	console.log(recommendationEl);

// 	// Update the text content of the <p> element with the recommendation:
// 	recommendationEl.textContent = recommendation;
// });
  