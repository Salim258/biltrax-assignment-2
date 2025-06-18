# ✅ 4. API Documentation

# API Endpoints Summary

## Method	Endpoint	Description

POST	/api/subscriptions/{id}/cancel	Cancel a subscription
POST	/api/subscriptions/{id}/reactivate	Reactivate a subscription

---

## Base URL:

```
http://your-domain.com/api
```

---

### POST `/subscriptions/{id}/cancel`

* **Description:** Cancels the subscription and dispatches all necessary events.
* **Parameters:**

  * `id` (URL parameter): Subscription ID.
* **Request Body:** None
* **Response:**

  ```json
  {
      "status": "success",
      "message": "Subscription cancelled successfully."
  }
  ```
* **Triggers:**

  * SubscriptionCancelledEvent
  * SubscriptionStatusChangedEvent

---

### POST `/subscriptions/{id}/reactivate`

* **Description:** Reactivates a cancelled subscription.
* **Parameters:**

  * `id` (URL parameter): Subscription ID.
* **Request Body:** None
* **Response:**

  ```json
  {
      "status": "success",
      "message": "Subscription reactivated successfully."
  }
  ```
* **Triggers:**

  * SubscriptionReactivatedEvent
  * SubscriptionStatusChangedEvent

---