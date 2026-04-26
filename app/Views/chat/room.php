<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - <?= esc($partner['fullname']) ?></title>
    <link href="<?= base_url('css/output.css') ?>" rel="stylesheet">
    <style>
        /* Background pattern ala Telegram/Whatsapp */
        .chat-bg {
            background-color: #E2E8F0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23cbd5e1' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="bg-gray-100 h-screen flex flex-col">

    <nav class="bg-white border-b border-gray-200 px-4 py-3 flex-shrink-0 flex items-center shadow-sm z-30">
        <a href="<?= base_url('dashboard') ?>" class="mr-4 text-gray-500 hover:text-gray-800 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        
        <div class="flex items-center">
            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-primary-500 to-blue-400 flex items-center justify-center text-white font-bold text-lg shadow-sm">
                <?= strtoupper(substr($partner['fullname'], 0, 1)) ?>
            </div>
            <div class="ml-3">
                <h2 class="text-base font-bold text-gray-900 leading-tight"><?= esc($partner['fullname']) ?></h2>
                <p class="text-xs text-green-500 font-medium">Online</p>
            </div>
        </div>
    </nav>

    <?php if(in_array($order['status'], ['pending', 'in_progress'])): ?>
        
        <div class="bg-white border-b border-gray-200 shadow-sm z-20 flex-shrink-0 px-4 py-3">
            <div class="max-w-4xl mx-auto flex items-start sm:items-center gap-4 flex-col sm:flex-row">
                
                <?php 
                    $images = !empty($service['image']) ? explode(',', $service['image']) : []; 
                    $thumbnail = (count($images) > 0 && !empty($images[0])) ? base_url('uploads/services/' . esc(trim($images[0]))) : '';
                ?>
                <?php if($thumbnail): ?>
                    <img src="<?= $thumbnail ?>" alt="Thumbnail" class="w-full sm:w-20 h-24 sm:h-20 object-cover rounded-lg border border-gray-200 flex-shrink-0 shadow-sm">
                <?php else: ?>
                    <div class="w-full sm:w-20 h-24 sm:h-20 bg-gray-100 rounded-lg flex items-center justify-center border border-gray-200 flex-shrink-0 shadow-sm">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                <?php endif; ?>

                <div class="flex-1 min-w-0 w-full">
                    <div class="flex items-start justify-between gap-2 mb-1">
                        <h3 class="text-sm sm:text-base font-bold text-gray-900 line-clamp-2"><?= esc($service['title']) ?></h3>
                        
                        <?php
                            $statusColors = [
                                'pending'     => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                'in_progress' => 'bg-blue-100 text-blue-800 border-blue-200',
                            ];
                            $statusLabels = [
                                'pending'     => 'Menunggu',
                                'in_progress' => 'Dikerjakan',
                            ];
                            $color = $statusColors[$order['status']] ?? 'bg-gray-100 text-gray-800';
                            $label = $statusLabels[$order['status']] ?? $order['status'];
                        ?>
                        <span class="px-2.5 py-1 text-[10px] font-bold rounded-md border shadow-sm whitespace-nowrap uppercase <?= $color ?>">
                            <?= $label ?>
                        </span>
                    </div>
                    
                    <p class="text-xs text-gray-500 mb-2">
                        Order ID: <span class="font-bold">#<?= str_pad($order['id'], 6, '0', STR_PAD_LEFT) ?></span> • <?= esc($service['delivery_time'] ?? '1') ?> Hari Pengerjaan
                    </p>
                    
                    <div class="flex flex-wrap items-center justify-between gap-2 mt-auto">
                        <div class="text-primary-600 font-black text-base">Rp <?= number_format($service['price'], 0, ',', '.') ?></div>
                        
                        <div class="flex items-center gap-3">
                            <a href="<?= base_url('service/' . $service['id']) ?>" target="_blank" class="text-xs text-gray-500 hover:text-primary-600 hover:underline font-medium transition">
                                Lihat Jasa
                            </a>

                            <?php if(session()->get('role') === 'freelancer'): ?>
                                <form action="<?= base_url('order/updateStatus/'.$order['id']) ?>" method="POST" class="flex items-center gap-1 border-l border-gray-300 pl-3">
                                    <select name="status" class="text-[11px] font-medium border-gray-300 text-gray-700 rounded bg-gray-50 py-1 pl-2 pr-6 focus:ring-primary-500 focus:border-primary-500 cursor-pointer">
                                        <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>Menunggu</option>
                                        <option value="in_progress" <?= $order['status'] == 'in_progress' ? 'selected' : '' ?>>Dikerjakan</option>
                                        <option value="completed" <?= $order['status'] == 'completed' ? 'selected' : '' ?>>Selesai</option>
                                        <option value="canceled" <?= $order['status'] == 'canceled' ? 'selected' : '' ?>>Batal</option>
                                    </select>
                                    <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white text-[10px] font-bold px-2 py-1.5 rounded shadow-sm transition">Update</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>
        <div class="bg-gray-50 border-b border-gray-200 px-4 py-2.5 z-20 flex justify-center items-center gap-2 shadow-inner">
            <?php if($order['status'] == 'completed'): ?>
                <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span class="text-xs font-bold text-green-700 uppercase tracking-wider">Pesanan Telah Selesai</span>
            <?php else: ?>
                <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                <span class="text-xs font-bold text-red-700 uppercase tracking-wider">Pesanan Dibatalkan</span>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <main id="chat-container" class="flex-1 overflow-y-auto p-4 chat-bg flex flex-col space-y-3 relative z-10">
        
        <div class="flex justify-center mb-4 mt-2">
            <span class="bg-[#FEF9C3] text-[#854D0E] text-xs px-4 py-2 rounded-lg shadow-sm border border-[#FEF08A] text-center max-w-md">
                Pesan dalam ruang ini dilindungi secara privasi antara Anda dan <strong><?= esc($partner['fullname']) ?></strong>. Dilarang bertransaksi di luar sistem.
            </span>
        </div>

        <div id="messages-box" class="flex flex-col space-y-3 pb-2">
            </div>
    </main>

    <footer class="bg-white border-t border-gray-200 px-4 py-3 flex-shrink-0 z-30">
        <form id="chat-form" class="flex items-center max-w-4xl mx-auto gap-2">
            
            <?php 
                $defaultText = "";
                if ($messageCount == 0 && $me == $order['client_id']) {
                    $defaultText = 'Halo, saya sudah membuat pesanan untuk "' . esc($service['title']) . '". Mohon segera diproses ya, terima kasih!';
                }
            ?>
            
            <input type="text" id="message-input" autocomplete="off" placeholder="Ketik pesan..." required
                value="<?= esc($defaultText) ?>" 
                class="flex-1 bg-gray-100 border border-gray-200 text-gray-900 text-sm rounded-full focus:ring-primary-500 focus:border-primary-500 block w-full px-4 py-3 transition shadow-inner">
            
            <button type="submit" class="w-12 h-12 rounded-full bg-primary-600 hover:bg-primary-700 text-white flex items-center justify-center shadow-md transition transform hover:scale-105 flex-shrink-0">
                <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
            </button>
        </form>
    </footer>

    <script>
        const orderId = <?= $order['id'] ?>;
        const myId = <?= $me ?>;
        const chatBox = document.getElementById('messages-box');
        const chatContainer = document.getElementById('chat-container');
        const chatForm = document.getElementById('chat-form');
        const messageInput = document.getElementById('message-input');
        
        let lastMessageCount = 0;

        async function fetchMessages() {
            try {
                const response = await fetch(`<?= site_url('chat/load/') ?>${orderId}`);
                const messages = await response.json();

                if (messages.length > lastMessageCount) {
                    lastMessageCount = messages.length;
                    chatBox.innerHTML = ''; 
                    
                    messages.forEach(msg => {
                        const isMe = msg.sender_id == myId;
                        const bubble = document.createElement('div');
                        bubble.className = `flex ${isMe ? 'justify-end' : 'justify-start'}`;
                        
                        bubble.innerHTML = `
                            <div class="max-w-[85%] sm:max-w-[70%] rounded-2xl px-4 py-2.5 shadow-sm relative ${
                                isMe ? 'bg-[#DCF8C6] text-gray-900 rounded-br-none border border-green-200' 
                                     : 'bg-white text-gray-900 rounded-bl-none border border-gray-100'
                            }">
                                <p class="text-sm leading-relaxed">${msg.message}</p>
                                <div class="text-[10px] ${isMe ? 'text-green-700' : 'text-gray-400'} mt-1 text-right font-medium">
                                    ${new Date(msg.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}
                                </div>
                            </div>
                        `;
                        chatBox.appendChild(bubble);
                    });

                    // Scroll ke bawah secara halus
                    chatContainer.scrollTo({
                        top: chatContainer.scrollHeight,
                        behavior: 'smooth'
                    });
                }
            } catch (error) {
                console.error("Gagal menarik pesan:", error);
            }
        }

        chatForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const msgText = messageInput.value.trim();
            if(!msgText) return;

            messageInput.value = ''; 

            const formData = new FormData();
            formData.append('message', msgText);

            await fetch(`<?= site_url('chat/send/') ?>${orderId}`, {
                method: 'POST',
                body: formData
            });

            fetchMessages(); 
        });

        fetchMessages();
        setInterval(fetchMessages, 2000);
    </script>

</body>
</html>