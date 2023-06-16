function img(o) {
    let temp = [];

    temp = o.split(" & ");
    temp = temp.filter(Boolean);

    let images = [];
    temp.forEach(image => {
        images.push("upload/" + image.replace(/[\[\]]/g, "").trim());
    });

    return '<img src="../admin/' + images[0] + '" width="100%" height="auto">';
}

//Function To set New price based on discount

function price(old, dis) {
    var old_price = old;
    var discount = dis;
    var new_price = old_price - (old_price * (discount / 100));
    return parseFloat(new_price).toFixed(2);
}