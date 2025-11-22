// import { scholarshipsData } from './data/scholarshipsData.js';

// const container = document.getElementById("scholarshipContainer");

// scholarshipsData.forEach(item => {
//     container.innerHTML += `
//         <div class="bg-white rounded-2xl shadow border border-[#D1D1D1] p-6 relative">

//             <span class="absolute top-4 left-4 bg-[#1565C0] text-white text-xs font-semibold px-3 py-1.5 rounded-full">
//                 University
//             </span>

//             <button class="absolute top-4 right-4 p-2">
//                 <iconify-icon icon="icon-park-outline:like" width="26" class="text-[#838383]"></iconify-icon>
//             </button>

//             <div class="flex justify-center mt-6">
//                 <img src="${item.logoUrl}" class="w-24 h-24 object-contain">
//             </div>

//             <h3 class="text-lg font-bold text-[#0B2027] mt-4 text-center">
//                 ${item.university}
//             </h3>

//             <p class="text-sm text-[#696969] text-center">
//                 ${item.location}
//             </p>

//             <p class="text-xs text-[#696969] text-center mt-3 mb-5">
//                 Rank #${item.rank.value} | ${item.acceptanceRate}% acceptance
//             </p>

//             <a href="/scholarships/${item.id}"
//                 class="w-full bg-white text-[#0B2027] py-2.5 rounded border border-[#D1D1D1] block text-center font-semibold text-sm hover:bg-[#F5F5F5]">
//                 Learn More
//             </a>
//         </div>
//     `;
// });
