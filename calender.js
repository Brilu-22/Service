// Sample events array
let events = [];

// Function to render the calendar
function renderCalendar() {
  const calendarElement = document.getElementById("calendar");
  calendarElement.innerHTML = ""; // Clear previous calendar content

  // Get current date
  const currentDate = new Date();

  // Render calendar header
  const month = currentDate.toLocaleString("default", { month: "long" });
  const year = currentDate.getFullYear();
  calendarElement.innerHTML += `<h2>${month} ${year}</h2>`;

  // Create grid for days of the month
  const daysInMonth = new Date(year, currentDate.getMonth() + 1, 0).getDate();
  for (let day = 1; day <= daysInMonth; day++) {
    const dayDiv = document.createElement("div");
    dayDiv.classList.add("day");
    dayDiv.textContent = day;

    // Check for events on this day and display them
    const dateString = `${year}-${String(currentDate.getMonth() + 1).padStart(
      2,
      "0"
    )}-${String(day).padStart(2, "0")}`;
    const todayEvents = events.filter((event) => {
      const startDate = new Date(event.start_time);
      return startDate.toISOString().split("T")[0] === dateString;
    });

    todayEvents.forEach((event) => {
      const eventDiv = document.createElement("div");
      eventDiv.classList.add("event");
      eventDiv.textContent = `${event.title} - ${event.start_time}`;
      dayDiv.appendChild(eventDiv);
    });

    calendarElement.appendChild(dayDiv);
  }
}

// Function to handle form submission
document.getElementById("event-form").addEventListener("submit", function (e) {
  e.preventDefault(); // Prevent the default form submission

  const title = document.querySelector("input[name='title']").value;
  const description = document.querySelector(
    "textarea[name='description']"
  ).value;
  const start_time = document.querySelector("input[name='start_time']").value;
  const end_time = document.querySelector("input[name='end_time']").value;

  // Add event to the events array
  events.push({ title, description, start_time, end_time });

  // Clear the form fields
  document.getElementById("event-form").reset();

  // Re-render the calendar
  renderCalendar();
});

// Initial render
renderCalendar();
