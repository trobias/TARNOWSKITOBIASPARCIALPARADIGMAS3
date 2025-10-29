const TIT_cart = [];
function TIT_add(id, nombre, precio){
  const ex = TIT_cart.find(i=>i.id===id);
  if(ex){ ex.qty++; } else { TIT_cart.push({id, nombre, precio:Number(precio), qty:1}); }
  TIT_render();
}
function TIT_render(){
  const ul = document.getElementById('TIT_list');
  const h = document.getElementById('TIT_hidden');
  ul.innerHTML=''; h.innerHTML='';
  let total = 0;
  TIT_cart.forEach(it=>{
    total += it.precio*it.qty;
    const li = document.createElement('li');
    li.textContent = `${it.nombre} x${it.qty} - $${(it.precio*it.qty).toFixed(2)}`;
    ul.appendChild(li);
    const input = document.createElement('input');
    input.type='hidden'; input.name='items[]'; input.value = `${it.id}|${it.qty}`;
    h.appendChild(input);
  });
  document.getElementById('TIT_total').textContent = total.toFixed(2);
  document.getElementById('TIT_badge').textContent = TIT_cart.reduce((a,b)=>a+b.qty,0);
}
