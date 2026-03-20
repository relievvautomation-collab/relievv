 // redirect links 
console.log(new Date().getFullYear() + " with love and grateful Developer Vishal ❤️");

// redirect links 
function windowredirecturl(url, target){
    window.open(url, target);
}




function counteranimation(){


    // Counter Animation Function
    function animateCounter(elementId, targetValue, suffix = '+', isPercentage = false , is247 = false ) { 
        const element = document.getElementById(elementId);
        let current = 0;
        const increment = targetValue / 50;  
        const timer = setInterval(() => {
            current += increment;
            if (current >= targetValue) {
                current = targetValue;
                clearInterval(timer);
            }
            
            // if (is247) {
            //     element.textContent = Math.floor(current) + '/7';
            // } else if (isPercentage) {
            //     element.textContent = Math.floor(current) + '%';
            // } else {
            //     element.textContent = Math.floor(current) + suffix;
            // }
        }, 30);  
    }
 
    window.addEventListener('load', function() {
        animateCounter('counter1', 5, '+');
        animateCounter('counter2', 1500, '+');
        animateCounter('counter3', 95, '', true);
        animateCounter('counter4', 24, '', false, true);
    }); 
}
 
// redirect 
 
