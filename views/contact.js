document.addEventListener('DOMContentLoaded', function() {
    const memberCard = document.querySelector('.member-card');
    
    memberCard.addEventListener('mouseover', function() {
        this.style.transform = 'translateY(-5px)';
    });
    
    memberCard.addEventListener('mouseout', function() {
        this.style.transform = 'translateY(0)';
    });
});
