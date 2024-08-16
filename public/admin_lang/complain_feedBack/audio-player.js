document.addEventListener('DOMContentLoaded', function () {
  // Function to convert seconds to a time string format
  var timeString = (secs) => {
    let ss = Math.floor(secs),
      hh = Math.floor(ss / 3600),
      mm = Math.floor((ss - hh * 3600) / 60);
    ss = ss - hh * 3600 - mm * 60;
    if (hh > 0) mm = mm < 10 ? "0" + mm : mm;
    ss = ss < 10 ? "0" + ss : ss;
    return hh > 0 ? `${hh}:${mm}:${ss}` : `${mm}:${ss}`;
  };

  // Function to set the progress bar's width
  function setProgress(elTarget) {
    let divisionNumber = elTarget.getAttribute("max") / 100;
    let rangeNewWidth = Math.floor(elTarget.value / divisionNumber);
    elTarget.nextSibling.style.width = rangeNewWidth > 95 ? "95%" : rangeNewWidth + "%";
  }

  // Initialize audio players
  for (let i of document.querySelectorAll(".aWrap")) {
    i.audio = new Audio(encodeURI(i.dataset.src));
    i.aPlay = i.querySelector(".aPlay");
    i.aPlayIco = i.querySelector(".aPlayIco i");
    i.aNow = i.querySelector(".aNow");
    i.aTime = i.querySelector(".aTime");
    i.aSeek = i.querySelector(".aSeek");
    i.aVolume = i.querySelector(".aVolume");
    i.aVolIco = i.querySelector(".aVolIco i");
    i.seeking = false;

    // Play/pause button click event
    i.aPlay.onclick = () => {
      if (i.audio.paused) {
        i.audio.play();
      } else {
        i.audio.pause();
      }
    };

    // Update play/pause icon based on audio state
    i.audio.onplay = () => (i.aPlayIco.textContent = 'pause');
    i.audio.onpause = () => (i.aPlayIco.textContent = 'play_arrow');

    // Handle loading state
    i.audio.onloadstart = () => {
      i.aNow.innerHTML = "Loading";
      i.aTime.innerHTML = "";
    };

    // Handle loaded metadata and initialize seek bar
    i.audio.onloadedmetadata = () => {
      i.aNow.innerHTML = timeString(0);
      i.aTime.innerHTML = timeString(i.audio.duration);
      i.aSeek.max = Math.floor(i.audio.duration);

      // Enable seek bar functionality
      i.aSeek.oninput = () => (i.seeking = true);
      i.aSeek.onchange = () => {
        i.audio.currentTime = i.aSeek.value;
        if (!i.audio.paused) {
          i.audio.play();
        }
        i.seeking = false;
      };

      // Update seek bar as audio plays
      i.audio.ontimeupdate = () => {
        if (!i.seeking) {
          i.aSeek.value = Math.floor(i.audio.currentTime);
        }
        i.aNow.innerHTML = timeString(i.audio.currentTime);
        let divisionNumber = i.aSeek.getAttribute("max") / 100;
        let rangeNewWidth = Math.floor(i.aSeek.value / divisionNumber);
        i.aSeek.nextSibling.style.width = rangeNewWidth > 95 ? "95%" : rangeNewWidth + "%";
      };
    };

    // Handle volume control
    i.aVolIco.onclick = () => {
      i.audio.volume = i.audio.volume == 0 ? 1 : 0;
      i.aVolume.value = i.audio.volume;
      i.aVolIco.textContent = i.aVolume.value == 0 ? 'volume_off' : 'volume_up';
      i.aVolume.nextSibling.style.width = i.aVolume.value == 0 ? "0%" : "95%";
    };
    i.aVolume.onchange = () => {
      i.audio.volume = i.aVolume.value;
      i.aVolIco.textContent = i.aVolume.value == 0 ? 'volume_off' : 'volume_up';
    };

    // Enable controls when audio is ready
    i.audio.oncanplaythrough = () => {
      i.aPlay.disabled = false;
      i.aVolume.disabled = false;
      i.aSeek.disabled = false;
    };

    // Disable controls during loading
    i.audio.onwaiting = () => {
      i.aPlay.disabled = true;
      i.aVolume.disabled = true;
      i.aSeek.disabled = true;
    };

    // Update progress bar on input
    i.aSeek.addEventListener("input", function () {
      setProgress(this);
    });

    // Update volume progress bar on input
    i.aVolume.addEventListener("input", function () {
      setProgress(this);
    });
  }
});

// Call the function to retrieve complain list
// retriveComplainList();
