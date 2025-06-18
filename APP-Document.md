# Application Documentation

### 📌 Core Entities:

* **Subscription:** The user’s active subscription.
* **BillingRecord:** Keeps track of billing history (charges/refunds).
* **ActivityLog:** Records subscription-related activities for audit.

---

### 📌 Subscription Flow:

#### Cancellation:

1. API call: `POST /subscriptions/{id}/cancel`

2. Updates subscription status to `cancelled`.

3. Fires:
   * `SubscriptionCancelledEvent`
   * `SubscriptionStatusChangedEvent`

4. Event Listeners:
   * Send cancellation email via job queue.
   * Process refund via job queue.
   * Create billing record update.
   * Log activity in activity logs.

#### Reactivation:

1. API call: `POST /subscriptions/{id}/reactivate`
2. Updates subscription status to `active`.
3. Fires:
   * `SubscriptionReactivatedEvent`
   * `SubscriptionStatusChangedEvent`

4. Event Listeners:
   * Send reactivation email via job queue.
   * Create billing record update.
   * Log activity in activity logs.

---

### 📌 Database Tables:

| Table            | Purpose                      |
| ---------------- | ---------------------------- |
| subscriptions    | Stores subscription records  |
| billing_records | Tracks charges and refunds   |
| activity_logs   | Logs all subscription events |

---