const array = [
  'manage.users',
  'view.projects',
  'view.projects.own',
  'view.users',
  'manage.organizations',
  'edit.projects',
  'view.organizations.own'
];


const simple = 'view.organizations.own'
const test = simple.substring(simple.indexOf(".") + 1)
console.log(test)
const second_part = simple.split('.').pop().split('.')[0];


// var firt_part = simple.substring(0, simple.indexOf('.'));
// console.log(second_part)
// console.log(firt_part)
let array2 = [

];
// console.log("____")
// console.log(simple.match(/\./g).length)
//
//
//

for (let i = 0; i < array.length; i++) {
  const second_part = array[i].split(".")
  var firt_part = array[i].substring(0, array[i].indexOf('.'));

  // array2.push(second_part)
  array2.push(
    {
      name: second_part[1],
      // permissions: firt_part
    }
  )
}
console.log(array2)


// var values="This is:the first program in JavaScript:efbdbfd";
// var result=[];
// result=values.split(":");
// console.log(result[1]);
