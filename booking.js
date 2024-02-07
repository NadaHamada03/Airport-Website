function goToCheckout(flightNumber) {
    window.location.href = 'checkout.html?flight=' + flightNumber;
}

document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const flightNumber = urlParams.get('flight');

    // Display ticket details on the checkout page
    document.getElementById('flight-number').innerText = flightNumber;

    // You can fetch additional details from a database or define them statically
    const flightDetails = {
        'ABC123': { departure: 'New York', destination: 'Los Angeles', price: 300 },
        'XYZ789': { departure: 'London', destination: 'Paris', price: 250 },
        'DEF456': { departure: 'Chicago', destination: 'Miami', price: 250 },
        'GHI789': { departure: 'San Francisco', destination: 'Seattle', price: 400 },
        'JKL012': { departure: 'Denver', destination: 'Phoenix', price: 200 },
        'MNO345': { departure: 'Atlanta', destination: 'Dallas', price: 350 },
        'PQR678': { departure: 'Boston', destination: 'San Diego', price: 280 },
        'STU901': { departure: 'Houston', destination: 'Las Vegas', price: 320 },
        'VWX234': { departure: 'Orlando', destination: 'Portland', price: 180 },
        'YZA567': { departure: 'Miami', destination: 'Denver', price: 270 },
        'BCD890': { departure: 'Seattle', destination: 'Chicago', price: 220 },
        'EFG123': { departure: 'Phoenix', destination: 'San Francisco', price: 380 },
        'HIJ456': { departure: 'Dallas', destination: 'Atlanta', price: 260 },
        'KLM789': { departure: 'San Diego', destination: 'Boston', price: 310 },
        'NOP012': { departure: 'Las Vegas', destination: 'Houston', price: 190 },
        'QRS345': { departure: 'Portland', destination: 'Orlando', price: 230 },
        'TUV678': { departure: 'Denver', destination: 'Phoenix', price: 240 },

        // Add more details as needed
    };

    // Populate the remaining details
    if (flightDetails[flightNumber]) {
        const { departure, destination, price } = flightDetails[flightNumber];
        document.getElementById('departure').innerText = departure;
        document.getElementById('destination').innerText = destination;
        document.getElementById('price').innerText = '$' + price.toFixed(2);
    }

    function calculateTotal() {
        const ticketCount = parseInt(document.getElementById('ticket-count').value, 10);
        const pricePerTicket = flightDetails[flightNumber].price;
        const totalPrice = ticketCount * pricePerTicket;
        document.getElementById('total-price').innerText = '$' + totalPrice.toFixed(2);
    }

    function buyTickets() {
        // Add your logic here for handling the purchase, e.g., sending data to a server
        alert('Tickets purchased successfully!');
    }

    // Attach functions to buttons
    document.getElementById('calculate-total-btn').addEventListener('click', calculateTotal);
    document.getElementById('buy-tickets-btn').addEventListener('click', buyTickets);
});