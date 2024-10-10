var current = null;

// Helper function for easing (easeOutQuart)
function easeOutQuart(t) {
  return 1 - --t * t * t * t;
}

// Animate function to replace anime.js functionality
function animatePath(targets, props, duration) {
  var start = null;
  var element = document.querySelector(targets);
  var initialStrokeDashoffset = parseFloat(
    getComputedStyle(element).strokeDashoffset
  );
  var initialStrokeDasharray = getComputedStyle(element)
    .strokeDasharray.split(" ")
    .map(Number);

  function animateStep(timestamp) {
    if (!start) start = timestamp;
    var progress = Math.min((timestamp - start) / duration, 1); // Normalize progress to 0-1
    var easedProgress = easeOutQuart(progress); // Apply easing

    // Animate strokeDashoffset
    if (props.strokeDashoffset) {
      var offsetValue =
        initialStrokeDashoffset +
        easedProgress *
          (props.strokeDashoffset.value - initialStrokeDashoffset);
      element.style.strokeDashoffset = offsetValue;
    }

    // Animate strokeDasharray
    if (props.strokeDasharray) {
      var dasharrayValue = [
        initialStrokeDasharray[0] +
          easedProgress *
            (props.strokeDasharray.value[0] - initialStrokeDasharray[0]),
        initialStrokeDasharray[1],
      ];
      element.style.strokeDasharray = dasharrayValue.join(" ");
    }

    if (progress < 1) {
      requestAnimationFrame(animateStep);
    }
  }

  requestAnimationFrame(animateStep);
}

document.querySelector("#email").addEventListener("focus", function (e) {
  if (current) cancelAnimationFrame(current); // Stop previous animation
  current = animatePath(
    "path",
    {
      strokeDashoffset: { value: 0 },
      strokeDasharray: { value: [240, 1386] },
    },
    700
  );
});

document.querySelector("#password").addEventListener("focus", function (e) {
  if (current) cancelAnimationFrame(current); // Stop previous animation
  current = animatePath(
    "path",
    {
      strokeDashoffset: { value: -336 },
      strokeDasharray: { value: [240, 1386] },
    },
    700
  );
});

document.querySelector("#submit").addEventListener("focus", function (e) {
  if (current) cancelAnimationFrame(current); // Stop previous animation
  current = animatePath(
    "path",
    {
      strokeDashoffset: { value: -730 },
      strokeDasharray: { value: [530, 1386] },
    },
    700
  );
});
