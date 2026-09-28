/**
 * MarketLink - AI Assistant Widget ("Ask MarketLink")
 * Interactive frontend assistant with preset smart responses
 */

(function() {
  const responses = {
    "tomatoes": "You can find fresh vine-ripened heirloom tomatoes at <strong>Vance Heritage Organic Farm</strong> located at the <em>Valley Green Community Market</em>. They are harvested every Friday and cost $4.50/lb.",
    "markets": "This weekend, <strong>Valley Green Community Market</strong> (Sat & Sun 8 AM - 2 PM) and <strong>Riverfront Organic Bazaar</strong> (Sat 7:30 AM - 1 PM) are open for pickup. You can reserve items up to 12 hours before opening!",
    "dairy": "<strong>Meadow Gold Pastures</strong> (Marcus Sterling) produces certified grass-fed raw milk, free-range eggs, and aged farmhouse cheddar at the <em>Highland Heritage Fair</em>.",
    "pickup": "Pickup is super easy! Simply select your preferred market day and time slot during checkout. You pay directly to the farmer in person when collecting your fresh produce box.",
    "honey": "Pure raw wildflower honey is available from <strong>Wild Blossom Apiary & Orchard</strong> at the Riverfront Bazaar ($11.50 per 16oz jar)."
  };

  function createAIAssistantDOM() {
    if (document.getElementById('marketlinkAIAssistant')) return;

    const wrapper = document.createElement('div');
    wrapper.id = 'marketlinkAIAssistant';
    wrapper.innerHTML = `
      <!-- Floating Trigger Button -->
      <button class="ai-assistant-toggle" id="aiAssistantToggle" aria-label="Open AI Assistant">
        <span class="ai-pulse-dot"></span>
        <i class="bi bi-robot fs-5"></i>
        <span>Ask MarketLink</span>
      </button>

      <!-- Chat Panel -->
      <div class="ai-assistant-panel" id="aiAssistantPanel" role="dialog" aria-modal="true" aria-label="MarketLink Assistant">
        <div class="ai-header">
          <div class="d-flex align-items-center gap-2">
            <div class="badge-dot bg-warning" style="width:10px; height:10px; border-radius:50%;"></div>
            <div>
              <h6 class="mb-0 text-white font-serif fs-6">MarketLink AI Assistant</h6>
              <small class="text-white-50" style="font-size:0.75rem;">Your local organic produce guide</small>
            </div>
          </div>
          <button class="btn btn-sm text-white p-0" id="aiAssistantClose" aria-label="Close Assistant">
            <i class="bi bi-x-lg fs-5"></i>
          </button>
        </div>

        <div class="ai-messages" id="aiMessagesContainer">
          <div class="ai-bubble bot">
            Hello! 🌿 I am your MarketLink organic assistant. Ask me anything about local farmers, weekend markets, weekly stock, or pickup slots!
          </div>
        </div>

        <!-- Quick Suggestions -->
        <div class="ai-quick-questions">
          <button class="quick-btn" data-query="Where can I find fresh tomatoes?">🍅 Fresh tomatoes?</button>
          <button class="quick-btn" data-query="Which markets are open today?">🧺 Open markets?</button>
          <button class="quick-btn" data-query="Which farmers sell dairy products?">🧀 Dairy & cheese?</button>
          <button class="quick-btn" data-query="What are the pickup hours?">⏰ Pickup hours?</button>
        </div>

        <!-- Input Area -->
        <form class="ai-input-area" id="aiInputForm">
          <input type="text" class="form-control form-control-sm rounded-pill" id="aiUserInput" placeholder="Ask a question..." autocomplete="off">
          <button type="submit" class="btn btn-forest btn-sm rounded-circle" style="width:36px; height:36px; padding:0;">
            <i class="bi bi-send-fill" style="font-size: 0.85rem;"></i>
          </button>
        </form>
      </div>
    `;

    document.body.appendChild(wrapper);

    // Event listeners
    const toggleBtn = document.getElementById('aiAssistantToggle');
    const panel = document.getElementById('aiAssistantPanel');
    const closeBtn = document.getElementById('aiAssistantClose');
    const form = document.getElementById('aiInputForm');
    const input = document.getElementById('aiUserInput');
    const messages = document.getElementById('aiMessagesContainer');

    toggleBtn.addEventListener('click', () => {
      panel.classList.toggle('active');
      if (panel.classList.contains('active')) {
        input.focus();
      }
    });

    closeBtn.addEventListener('click', () => {
      panel.classList.remove('active');
    });

    function appendMessage(text, isUser = false) {
      const bubble = document.createElement('div');
      bubble.className = `ai-bubble ${isUser ? 'user' : 'bot'}`;
      bubble.innerHTML = text;
      messages.appendChild(bubble);
      messages.scrollTop = messages.scrollHeight;
    }

    function processQuery(query) {
      appendMessage(query, true);
      const lower = query.toLowerCase();

      setTimeout(() => {
        let answer = "I'm here to help you connect with local growers! You can browse our <strong>Markets</strong> and <strong>Farmers</strong> pages for specific stalls, or visit our catalog for seasonal harvest stock.";
        if (lower.includes('tomato')) answer = responses.tomatoes;
        else if (lower.includes('market') || lower.includes('open') || lower.includes('today')) answer = responses.markets;
        else if (lower.includes('dairy') || lower.includes('milk') || lower.includes('cheese') || lower.includes('egg')) answer = responses.dairy;
        else if (lower.includes('pickup') || lower.includes('hour') || lower.includes('pay') || lower.includes('order')) answer = responses.pickup;
        else if (lower.includes('honey')) answer = responses.honey;

        appendMessage(answer, false);
      }, 500);
    }

    form.addEventListener('submit', (e) => {
      e.preventDefault();
      const val = input.value.trim();
      if (!val) return;
      processQuery(val);
      input.value = '';
    });

    document.querySelectorAll('.quick-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const query = btn.getAttribute('data-query');
        processQuery(query);
      });
    });
  }

  document.addEventListener('DOMContentLoaded', createAIAssistantDOM);
})();
