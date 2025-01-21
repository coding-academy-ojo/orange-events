document.addEventListener('DOMContentLoaded', function () {
    loadNotifications();

    setInterval(loadNotifications, 30000);

    document.querySelector('#markAllAsRead').addEventListener('click', function (e) {
        e.preventDefault();
        markAllAsRead();
    });

    document.querySelector('.notifications').addEventListener('scroll', function () {
        if (this.scrollTop + this.clientHeight >= this.scrollHeight - 50 && currentPage < lastPage) {
            loadNotifications(currentPage + 1);
        }
    });
});

let currentPage = 1;
let lastPage = 1;
let loading = false;

function updateBadge(count) {
    const badge = document.querySelector('.badge-number');
    const headerText = document.querySelector('.dropdown-header');
    const markAllAsReadButton = document.querySelector('#markAllAsRead');

    if (count > 0) {
        badge.textContent = count;
        badge.style.display = 'inline-block';
        headerText.firstChild.textContent = `You have ${count} new notifications`;
        markAllAsReadButton.style.display = 'inline-block';
    } else {
        badge.style.display = 'none';
        headerText.firstChild.textContent = 'No new notifications';
        markAllAsReadButton.style.display = 'none';
    }
}

function loadNotifications(page = 1) {
    if (loading) return;
    loading = true;

    const spinner = document.getElementById('loadingSpinner');
    spinner.style.display = 'block';

    fetch('/getUnreadNotifications')
        .then(response => response.json())
        .then(data => updateBadge(data.total || 0))
        .catch(error => console.error('Error loading unread count:', error));

    fetch(`/getNotifications?page=${page}`)
        .then(response => response.json())
        .then(data => {
            lastPage = data.last_page;
            const notificationsList = document.querySelector('.notifications');
            const dropdownFooter = notificationsList.querySelector('.dropdown-footer');

            if (page === 1) {
                const items = notificationsList.querySelectorAll('.notification-item, .dropdown-divider, .load-more-btn');
                items.forEach(item => item.remove());
            }

            data.data.forEach(notification => {
                try {
                    const notificationData = typeof notification.data === 'string'
                        ? JSON.parse(notification.data)
                        : notification.data;

                    const timeAgo = moment(notification.created_at).fromNow();
                    let itemContent = '';

                    if (notificationData.attendee) {
                        let iconClass = 'bi-info-circle text-primary';
                        let reasonParagraph = '';

                        if (notificationData.attendee.confirmation === 'confirmed') {
                            iconClass = 'bi-check-circle text-success';
                        } else if (notificationData.attendee.confirmation === 'declined') {
                            iconClass = 'bi-x-circle text-danger';
                            reasonParagraph = `<p>Reason: ${notificationData.attendee.reason}</p>`;
                        }

                        itemContent = `
                            <h4>${notificationData.title}</h4>
                            <p>Status: ${notificationData.attendee.confirmation}</p>
                            ${reasonParagraph}
                        `;
                    } else if (notificationData.title) {
                        itemContent = `<h4>${notificationData.title}</h4>`;
                    } else {
                        itemContent = `<h4>Unknown Notification</h4>`;
                    }

                    const item = `
                        <li class="notification-item ${!notification.read_at ? 'unread' : ''}" data-id="${notification.id}" role="menuitem" tabindex="0">
                            <i class="bi bi-info-circle text-primary"></i>
                            <div>
                                ${itemContent}
                                <p>${timeAgo}</p>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                    `;

                    dropdownFooter.insertAdjacentHTML('beforebegin', item);
                } catch (error) {
                    console.error('Error processing notification:', error);
                }
            });

            document.querySelectorAll('.notification-item').forEach(item => {
                item.addEventListener('click', function () {
                    const notificationId = this.dataset.id;
                    markAsRead(notificationId, this);
                });
            });

            currentPage = data.current_page;
            spinner.style.display = 'none';
            loading = false;
        })
        .catch(error => {
            console.error('Error loading notifications:', error);
            spinner.style.display = 'none';
            loading = false;
        });
}

function markAsRead(notificationId, notificationElement) {
    fetch(`/markAsRead/${notificationId}`)
        .then(response => response.json())
        .then(() => {
            if (notificationElement) {
                notificationElement.classList.remove('unread');
            }
            updateBadge(document.querySelectorAll('.notification-item.unread').length);
        })
        .catch(error => console.error('Error marking as read:', error));
}

function markAllAsRead() {
    fetch('/markAllAsRead')
        .then(() => loadNotifications(1))
        .catch(error => console.error('Error marking all as read:', error));
}
